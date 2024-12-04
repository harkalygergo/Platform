<?php

namespace App\Controller\Platform;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Translation\TranslatorInterface;

class PlatformController extends AbstractController
{
    public function __construct(
        protected RequestStack $requestStack,
        protected \Doctrine\Persistence\ManagerRegistry $doctrine,
        protected TranslatorInterface $translator
    ) {
    }

    public function getPlatformBasicEnviroments()
    {
        return [
            'robots'        => '',
            'keywords'      => '',
            'description'   => '',
            'title'         => 'PLATFORM',
            'locale'        => $this->requestStack->getCurrentRequest()->getLocale(),
            'request'       => $this->requestStack->getCurrentRequest()->query->all(),
            'ip'            => $this->requestStack->getCurrentRequest()->getClientIp(),
            'userAgent'     => $this->requestStack->getCurrentRequest()->headers->get('User-Agent'),
        ];
    }
}
