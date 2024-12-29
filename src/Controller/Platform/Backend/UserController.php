<?php

namespace App\Controller\Platform\Backend;

use App\Controller\Platform\PlatformController;
use App\Entity\Platform\User;
use App\Form\Platform\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[IsGranted(User::ROLE_USER)]
class UserController extends PlatformController
{
    public function __construct(RequestStack $requestStack, \Doctrine\Persistence\ManagerRegistry $doctrine, TranslatorInterface $translator)
    {
        parent::__construct($requestStack, $doctrine, $translator);
    }

    #[Route('/{_locale}/admin/v1/account/edit', name: 'admin_v1_account_edit')]
    public function editAccount(
        #[CurrentUser] User $user,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'updated');

            return $this->redirectToRoute('admin_v1_account_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('platform/backend/v1/form.html.twig', [
            'sidebarMenu' => (new SidebarController($this->requestStack, $this->doctrine, $this->translator))->getSidebarMenu(),
            'title' => 'Saját adataim szerkesztése',
            'form' => $form->createView(),
        ]);

    }


}
