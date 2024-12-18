<?php

namespace App\Controller\Platform\Backend;

use App\Controller\Platform\PlatformController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Translation\TranslatorInterface;

class SidebarController extends PlatformController
{
    public function __construct(RequestStack $requestStack, \Doctrine\Persistence\ManagerRegistry $doctrine, TranslatorInterface $translator)
    {
        parent::__construct($requestStack, $doctrine, $translator);
    }

    public function getSidebarMenu(): array
    {
        return [
            'dashboard' => [
                'icon' => 'bi bi-speedometer2',
                'title' => $this->translator->trans('aside.dashboard'),
                'route' => 'admin_v1_dashboard',
            ],
            'favourites' => [
                'icon' => 'bi bi-star',
                'title' => $this->translator->trans('aside.favourites'),
                'route' => '',
                'children' => [
                    'intranet' => [
                        'icon' => 'bi bi-info-circle',
                        'title' => 'Intranet',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                ]
            ],
            'erp' => [
                'icon' => '',
                'title' => 'ERP | Vállalkozásirányítás',
                'route' => '',
                'children' => [
                    'customers' => [
                        'icon' => 'bi bi-person-lines-fill',
                        'title' => 'Customers',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'products' => [
                        'icon' => 'bi bi-box-seam',
                        'title' => 'Products',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'orders' => [
                        'icon' => 'bi bi-cart4',
                        'title' => 'Orders',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'invoices' => [
                        'icon' => 'bi bi-file-earmark-text',
                        'title' => 'Invoices',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'reports' => [
                        'icon' => 'bi bi-file-earmark-bar-graph',
                        'title' => 'Reports',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                ]
            ],
            'settings' => [
                'icon' => 'bi bi-gear',
                'title' => 'Settings',
                'route' => '',
                'children' => []
            ],
        ];
    }
}
