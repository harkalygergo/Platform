<?php

namespace App\Controller\Platform\Backend;

use App\Controller\Platform\PlatformController;
use App\Entity\Platform\BillingProfile;
use App\Entity\Platform\Cart;
use App\Entity\Platform\Service;
use App\Form\Platform\BillingProfileType;
use App\Repository\Platform\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends PlatformController
{
    #[Route('/{_locale}/admin/v1/checkout', name: 'admin_v1_checkout')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $instances = $user->getInstances();
        $billingProfiles = $this->doctrine->getRepository(BillingProfile::class)->findByUserInstances($instances);


        $cart = $this->doctrine->getRepository(Cart::class)->findOneBy(['user' => $this->getUser()]);

        if (!$cart) {
            $cart = (new Cart())->setUser($this->getUser());
        }

        $items = $cart->getItems();

        $cartServices = [];
        $feeSum = 0;

        if (!is_null($items)) {
            foreach ($items as $item) {
                $service = $this->doctrine->getRepository(Service::class)->find($item);
                $cartServices[] = $service;
                $feeSum += $service->getFee();
            }
        }


        $instance = $this->getUser()->getInstances()->first();
        $services = (new ServiceRepository($this->doctrine))->findBy(['instance' => $instance]);


        return $this->render('platform/backend/v1/checkout.html.twig', [
            'sidebarMenu' => (new SidebarController($this->requestStack, $this->doctrine, $this->translator))->getSidebarMenu(),
            'title' => 'Pénztár',
            'tableHead' => [
                'name' => 'Megnevezés',
                'description' => $this->translator->trans('data.description'),
                'type' => 'Típus',
                'fee' => 'Díj',
                'currency' => 'Pénznem',
                'frequencyOfPayment' => 'Fizetési gyakoriság',
                //'nextPaymentDate' => 'Következő fizetési dátum',
                'status' => 'Státusz',
            ],
            //'tableBody' => (new ServiceRepository($this->doctrine))->findAll(),
            'tableBody' => $cartServices,
            'actions' => [
                'view',
                'edit',
                'delete',
            ],
            'feeSum' => $feeSum,
            'billingProfiles' => $billingProfiles,
            'services' => $services,
        ]);
    }
}
