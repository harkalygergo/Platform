<?php

namespace App\Controller\Platform\Frontend;

use App\Controller\Platform\PlatformController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends PlatformController
{
    #[Route('/admin', name: 'honeypot_admin')]
    #[Route('/wp-admin', name: 'honeypot_wp_admin')]
    #[Route('/administrator', name: 'honeypot_administrator')]
    #[Route('/login', name: 'honeypot_login')]
    public function honeypot(): Response
    {
        $environment = $this->getPlatformBasicEnviroments();

        return $this->render('platform/frontend/restricted.html.twig', $environment);
    }

    #[Route('/{_locale}/admin', name: 'login')]
    public function index(Request $request): Response
    {
        // if i is a posted request, redirect to the dashboard
        if ($request->isMethod('POST')) {
            dump($request->isMethod('POST'));
            return $this->redirectToRoute('admin_v1_dashboard');
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
}
