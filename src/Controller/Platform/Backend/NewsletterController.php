<?php

namespace App\Controller\Platform\Backend;

use App\Controller\Platform\PlatformController;
use App\Entity\Platform\Newsletter;
use App\Entity\Platform\User;
use App\Form\Platform\NewsletterType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/{_locale}/admin/v1/newsletter')]
#[IsGranted(User::ROLE_USER)]
class NewsletterController extends PlatformController
{
    #[Route('/', name: 'admin_v1_newsletter')]
    public function index(): Response
    {
        $user = $this->getUser();
        $instances = $user->getInstances();
        $newsletters = $this->doctrine->getRepository(Newsletter::class)->findByUserInstances($instances);

        return $this->render('platform/backend/v1/list.html.twig', [
            'sidebarMenu' => $this->getSidebarController()->getSidebarMenu(),
            'title' => 'Hírlevelek',
            'tableHead' => [
                'subject' => 'Tárgy',
            ],
            'tableBody' => $newsletters,
            'actions' => [
                'view',
                'edit',
                'delete',
            ],
        ]);
    }

    #[Route('/add/', name: 'admin_v1_newsletter_add')]
    public function add(): Response
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($this->requestStack->getCurrentRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $newsletter->setInstance($this->getUser()->getInstances()[0]);
            $this->doctrine->getManager()->persist($newsletter);
            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('admin_v1_newsletter');
        }

        return $this->render('platform/backend/v1/form.html.twig', [
            'sidebarMenu' => $this->getSidebarController()->getSidebarMenu(),
            'title' => 'Hírlevél hozzáadása',
            'form' => $form->createView(),
        ]);
    }

}
