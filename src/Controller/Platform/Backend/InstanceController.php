<?php

namespace App\Controller\Platform\Backend;

use App\Controller\Platform\PlatformController;
use App\Entity\Platform\Instance;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstanceController extends PlatformController
{
    #[Route('/{_locale}/admin/v1/instances', name: 'admin_v1_instances')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $instances = $user->getInstances();

        return $this->render('platform/backend/v1/list.html.twig', [
            'sidebarMenu' => $this->getSidebarController()->getSidebarMenu(),
            'title' => 'Instances',
            'tableHead' => [
                'name' => 'Name',
                'status' => 'Status',
            ],
            'tableBody' => $instances,
            'actions' => [
                'view',
                'edit',
                'delete',
            ],
        ]);
    }

    #[Route('/{_locale}/admin/v1/instances/add', name: 'admin_v1_instances_add')]
    public function add(Request $request): Response
    {
        $instance = new Instance();
        $form = $this->createForm(InstanceType::class, $instance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$instance->setUser($this->getUser());
            $this->doctrine->getManager()->persist($instance);
            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('admin_v1_instances');
        }

        return $this->render('platform/backend/v1/form.html.twig', [
            'sidebarMenu' => $this->getSidebarController()->getSidebarMenu(),
            'title' => 'Add instance',
            'form' => $form->createView(),
        ]);
    }
}
