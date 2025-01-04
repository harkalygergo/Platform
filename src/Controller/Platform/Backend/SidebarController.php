<?php

namespace App\Controller\Platform\Backend;

use App\Controller\Platform\PlatformController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SidebarController extends PlatformController
{
    public function __construct(
        RequestStack $requestStack,
        \Doctrine\Persistence\ManagerRegistry $doctrine,
        TranslatorInterface $translator,
        KernelInterface $kernel
    )
    {
        parent::__construct($requestStack, $doctrine, $translator, $kernel);
    }

    public function getSidebarMenu(string $type = 'main'): ?array
    {
        $sidebar = file_get_contents($this->kernel->getProjectDir() . '/_platform/config/sidebar.json');
        $sidebar = json_decode($sidebar, true);

        if ($sidebar) {
            return $sidebar[$type];
        }

        return null;
    }
}
