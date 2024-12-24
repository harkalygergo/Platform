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
                        'icon' => 'bi bi-info-square',
                        'title' => 'Intranet',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                ]
            ],
            'crm' => [
                'icon' => '',
                'title' => 'CRM | Ügyfélkapcsolatok',
                'route' => '',
                'children' => [
                    'customers' => [
                        'icon' => 'bi bi-people',
                        'title' => 'Ügyféllista',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'products' => [
                        'icon' => 'bi bi-box-seam',
                        'title' => 'Hírlevél',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'form' => [
                        'icon' => 'bi bi-cart4',
                        'title' => 'Űrlapok',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'automatics' => [
                        'icon' => 'bi bi-file-earmark-text',
                        'title' => 'Automatizmusok',
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
                    'task' => [
                        'icon' => 'bi bi-list-task',
                        'title' => 'Feladatkezelő',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                ]
            ],
            'cms' => [
                'icon' => '',
                'title' => 'CMS | Tartalomkezelés',
                'route' => '',
                'children' => [
                    'domain' => [
                        'icon' => 'bi bi-link-45deg',
                        'title' => 'Domain',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'website' => [
                        'icon' => 'bi bi-globe',
                        'title' => 'Honlap',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'webshop' => [
                        'icon' => 'bi bi-cart',
                        'title' => 'Webshop',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'webapp' => [
                        'icon' => 'bi bi-window',
                        'title' => 'Webalkalmazás',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'mobilapp' => [
                        'icon' => 'bi bi-phone',
                        'title' => 'Mobil alkalmazás',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                ]
            ],
            'ecom' => [
                'icon' => '',
                'title' => 'ECOM | Értékesítés',
                'route' => '',
                'children' => [
                    'domain' => [
                        'icon' => 'bi bi-shop',
                        'title' => 'Termékek',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'website' => [
                        'icon' => 'bi bi-bag-x',
                        'title' => 'Elhagyott kosarak',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'webshop' => [
                        'icon' => 'bi bi-basket',
                        'title' => 'Vásárlások',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'payment' => [
                        'icon' => 'bi bi-credit-card',
                        'title' => 'Fizetési módok',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'shipping' => [
                        'icon' => 'bi bi-truck',
                        'title' => 'Szállítási módok',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'analytics' => [
                        'icon' => 'bi bi-bar-chart',
                        'title' => 'Analitika',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                ]
            ],
            'tool' => [
                'icon' => 'bi bi-gear',
                'title' => 'Eszközök',
                'route' => '',
                'children' => [
                    'storage' => [
                        'icon' => 'bi bi-hdd',
                        'title' => 'Tárhely',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'link' => [
                        'icon' => 'bi bi-link-45deg',
                        'title' => 'Link rövidítés',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                    'exportimport' => [
                        'icon' => 'bi bi-arrow-down-up',
                        'title' => 'Export/import',
                        'route' => 'admin_v1_dashboard',
                        'children' => []
                    ],
                ]
            ],
        ];
    }
}
