<?php

namespace App\Controller\Platform\Backend\Page;

use App\Controller\Platform\Backend\BackendController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends BackendController
{
    #[Route('/{_locale}/admin/v1/page/edit', name: 'admin_v1_page_edit')]
    public function pageEdit(): Response
    {
        return $this->render('platform/backend/v1/page/edit.html.twig', [
            'sidebarMenu' => $this->getSidebarController()->getSidebarMenu(),
            'title' => 'Hozzáférés megtagadva',
        ]);
    }

}
