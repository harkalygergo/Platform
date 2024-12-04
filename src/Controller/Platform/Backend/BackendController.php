<?php

namespace App\Controller\Platform\Backend;

use App\Controller\Platform\PlatformController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class BackendController extends PlatformController
{
    public function __construct(RequestStack $requestStack, \Doctrine\Persistence\ManagerRegistry $doctrine, TranslatorInterface $translator)
    {
        parent::__construct($requestStack, $doctrine, $translator);
    }

    #[Route('/{_locale}/admin/v1/dashboard', name: 'admin_v1_dashboard')]
    public function index(): Response
    {
        return $this->render('backend/v1/index.html.twig', [
            'sidebarMenu' => (new SidebarController($this->requestStack, $this->doctrine, $this->translator))->getSidebarMenu(),
        ]);
    }
}
