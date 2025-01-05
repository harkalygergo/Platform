<?php

namespace App\Controller\Platform\Backend;

use App\Controller\Platform\PlatformController;
use App\Repository\Platform\ServiceRepository;
use App\Repository\Platform\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class BackendController extends PlatformController
{
    public function __construct(RequestStack $requestStack, \Doctrine\Persistence\ManagerRegistry $doctrine, TranslatorInterface $translator, KernelInterface $kernel)
    {
        parent::__construct($requestStack, $doctrine, $translator, $kernel);
    }

    #[Route('/{_locale}/admin/v1/access-denied', name: 'admin_v1_access-denied')]
    public function accessDenied(): Response
    {
        return $this->render('platform/backend/v1/access-denied.html.twig', [
            'sidebarMenu' => $this->getSidebarController()->getSidebarMenu(),
            'title' => 'Hozzáférés megtagadva',
        ]);
    }


    #[Route('/{_locale}/admin/v1/dashboard', name: 'admin_v1_dashboard')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }

        $instance = $this->getUser()->getInstances()->first();
        $instanceUsers = $instance->getUsers();
        $services = (new ServiceRepository($this->doctrine))->findBy(['instance' => $instance]);

        return $this->render('platform/backend/v1/dashboard.html.twig', [
            'sidebarMenu' => $this->getSidebarController()->getSidebarMenu(),
            'instanceUsers' => $instanceUsers,
            'title' => 'Szolgáltatások',
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
            'tableBody' => $services,
            'actions' => [
                'view',
                'edit',
                'delete',
            ],
        ]);
    }

    #[Route('/{_locale}/admin/v1/users', name: 'admin_v1_users')]
    public function users(): Response
    {
        return $this->render('platform/backend/v1/list.html.twig', [
            'sidebarMenu' => $this->getSidebarController()->getSidebarMenu(),
            'title' => $this->translator->trans('aside.users'),
            'tableHead' => [
                'lastName' => 'Vezetéknév',
                'firstName' => 'Keresztnév',
                'phone' => 'Telefonszám',
                'email' => 'E-mail cím',
                'status' => 'Státusz',
            ],
            'tableBody' => (new UserRepository($this->doctrine))->findAll()
        ]);
    }
}
