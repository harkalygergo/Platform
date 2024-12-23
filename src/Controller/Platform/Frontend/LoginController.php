<?php

namespace App\Controller\Platform\Frontend;

use App\Controller\Platform\PlatformController;
use App\Entity\Platform\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends PlatformController
{
    #[Route('/', name: 'honeypot')]
    #[Route('/admin', name: 'honeypot_admin')]
    #[Route('/wp-admin', name: 'honeypot_wp_admin')]
    #[Route('/administrator', name: 'honeypot_administrator')]
    #[Route('/login', name: 'honeypot_login')]
    #[Route('/register', name: 'honeypot_register')]
    public function honeypot(): Response
    {
        // if user is logged in, redirect to the dashboard
        if ($this->getUser()) {
            return $this->redirectToRoute('admin_v1_dashboard');
        }

        $environment = $this->getPlatformBasicEnviroments();

        return $this->render('platform/frontend/restricted.html.twig', $environment);
    }

    #[Route('/{_locale}/admin', name: 'login')]
    public function index(Request $request, Security $security): Response
    {
        //dump($_POST);
        //dd($request->getMethod());
        // if i is a posted request, redirect to the dashboard
        if ($request->isMethod('POST')) {
            $postedData = $request->request->all();
            $username = $postedData['username'];
            // check in users table if the username exists as email
            $userRepo = $this->doctrine->getRepository(User::class);
            $user = $userRepo->findOneBy(['email' => $username]);
            if ($user) {
                // check if the password is correct
                $password = $postedData['password'];
                if (password_verify($password, $user->getPassword())) {
                    // if the password is correct, redirect to the dashboard
                    $security->login($user, 'form_login', 'main');

                    $user->setLastLogin(new \DateTimeImmutable());
                    $this->doctrine->getManager()->flush();

                    return $this->redirectToRoute('admin_v1_dashboard');
                }
            }
        }

        if ($this->getUser()) {
            return $this->redirectToRoute('admin_v1_dashboard');
        }

        // if it is a post request, redirect to the dashboard
        if ($this->isCsrfTokenValid('authenticate', $request->get('_csrf_token'))) {
            return $this->redirectToRoute('admin_v1_dashboard');
        }

        return $this->render('platform/frontend/login.html.twig');
    }

    #[Route('/{_locale}/admin/logout', name: 'admin_logout')]
    public function logout(Security $security): Response
    {
        $user = $this->getUser();
        if ($user) {
            $security->logout();
        }

        return $this->redirectToRoute('login');
    }
}
