<?php

namespace App\Controller\Platform\Backend;

use App\Controller\Platform\PlatformController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupportController extends PlatformController
{
    #[Route('/{_locale}/admin/v1/support', name: 'admin_v1_support')]
    public function index(Request $request): Response
    {
        return $this->render('platform/backend/v1/support/index.html.twig', [
            'sidebarMenu' => $this->getSidebarController()->getSidebarMenu(),
            'title' => 'Support',
        ]);
    }
}
