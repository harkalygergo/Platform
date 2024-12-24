<?php

namespace App\Controller\Platform\Backend;

use App\Controller\Platform\PlatformController;
use App\Entity\Platform\BillingProfile;
use App\Entity\Platform\Cart;
use App\Entity\Platform\Order;
use App\Entity\Platform\Service;
use App\Entity\Platform\User;
use App\Form\Platform\BillingProfileType;
use App\Repository\Platform\ServiceRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class OrderController extends PlatformController
{
    #[Route('/{_locale}/admin/v1/orders', name: 'admin_v1_orders')]
    public function index(Request $request): Response
    {
        $orders = $this->doctrine->getRepository(Order::class)->findAll();

        return $this->render('platform/backend/v1/list.html.twig', [
            'sidebarMenu' => (new SidebarController($this->requestStack, $this->doctrine, $this->translator))->getSidebarMenu(),
            'title' => 'Rendelések',
            'tableHead' => [
                'createdAt' => 'Rendelés dátuma',
                'createdBy' => 'Rendelő',
                'instance' => 'Intézmény',
                'total' => 'Összeg',
                'currency' => 'Pénznem',
                'items' => 'Tételek',
                'billingProfile' => 'Számlázási profil',
                'paymentStatus' => 'Fizetési státusz',
            ],
            'tableBody' => $orders,
            'actions' => [
                'view',
                'edit',
                'delete',
            ],
        ]);
    }

    #[Route('/{_locale}/admin/v1/orders/view/{id}', name: 'admin_v1_orders_view')]
    public function view(Request $request, int $id): Response
    {
        $order = $this->doctrine->getRepository(Order::class)->find($id);

        return $this->render('platform/backend/v1/view.html.twig', [
            'sidebarMenu' => (new SidebarController($this->requestStack, $this->doctrine, $this->translator))->getSidebarMenu(),
            'title' => 'Rendelés megtekintése',
            'order' => $order,
        ]);
    }

    #[Route('/{_locale}/admin/v1/orders/edit/{id}', name: 'admin_v1_orders_edit')]
    public function edit(Request $request, int $id): Response
    {
        $order = $this->doctrine->getRepository(Order::class)->find($id);

        return $this->render('platform/backend/v1/edit.html.twig', [
            'sidebarMenu' => (new SidebarController($this->requestStack, $this->doctrine, $this->translator))->getSidebarMenu(),
            'title' => 'Rendelés szerkesztése',
            'order' => $order,
        ]);
    }

    #[Route('/{_locale}/admin/v1/orders/delete/{id}', name: 'admin_v1_orders_delete')]
    public function delete(Request $request, int $id): Response
    {
        $order = $this->doctrine->getRepository(Order::class)->find($id);

        return $this->render('platform/backend/v1/delete.html.twig', [
            'sidebarMenu' => (new SidebarController($this->requestStack, $this->doctrine, $this->translator))->getSidebarMenu(),
            'title' => 'Rendelés törlése',
            'order' => $order,
        ]);
    }

    #[Route('/{_locale}/admin/v1/orders/create', name: 'admin_v1_orders_create')]
    public function create(Request $request, MailerInterface $mailer, LoggerInterface $logger, SerializerInterface $serializer): Response
    {
        // get billing profile object based on posted integer id
        $billingProfile = $this->doctrine->getRepository(BillingProfile::class)->find($request->request->get('billingProfile'));

        $order = new Order();
        $order->setBillingProfile($billingProfile);
        $order->setPaymentStatus('fizetésre vár');
        $order->setCurrency('HUF');
        $order->setTotal($request->request->get('total'));
        $order->setCreatedAt(new \DateTimeImmutable());
        $order->setCreatedBy($this->getUser());
        $order->setInstance($this->getUser()->getInstances()->first());
        $order->setItems($this->getUser()->getCart()->getItems());
        $order->setComment($request->request->get('comment'));

        $this->doctrine->getManager()->persist($order);
        $this->doctrine->getManager()->flush();

        $emailBody = "Rendelés azonosító: #" . $order->getId() . "\n";
        $emailBody .= "Név: " . $order->getCreatedBy()->getFullName() . "\n";
        $emailBody .= "Szervezet: " . $order->getInstance()->getName() . "\n";
        $emailBody .= "Összeg: " . $order->getTotal() . "\n";
        $emailBody .= "Fizetési mód: " . $request->request->get('paymentMethod') . "\n";
        $emailBody .= "Számlázási profil: " . $request->request->get('billingProfile') . "\n";
        $emailBody .= "Megjegyzés: " . $order->getComment() . "\n";
        $emailBody .= "\n Tételek: \n";

        foreach ($order->getItems() as $item) {
            $service = $this->doctrine->getRepository(Service::class)->find($item);
            $emailBody .= $service->getName() . " - " . $service->getType() . " - " . $service->getFee() . " " . $service->getCurrency() . "\n";
        }

        //$emailBody .= $serializer->serialize($order->getItems(), 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['cart']]);

        $toAddresses = [
            'hello@brandcomstudio.com',
            'gergo.harkaly@gmail.com',
            // logged in user email
            $this->getUser()->getEmail(),
        ];

        foreach ($toAddresses as $toAddress) {
            $email = (new Email())
                ->from(Address::create('PLATFORM <smtp@platform.brandcomstudio.com>'))
                ->to($toAddress)
                //->bcc('test-e75btfj0o@srv1.mail-tester.com')
                ->replyTo('hello@brandcomstudio.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Új megrendelés: #'. $order->getId())
                ->text($emailBody);

            $logger->info('Sending email', ['email' => $order]);
            $mailer->send($email);
        }

        // empty the cart
        $cart = $this->getUser()->getCart();
        $cart->setItems([]);
        $this->doctrine->getManager()->persist($cart);
        $this->doctrine->getManager()->flush();

        // return with new order ID
        return new Response($order->getId());
    }
}
