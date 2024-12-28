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
                        'route' => '',
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
                        'route' => '',
                        'children' => []
                    ],
                    'products' => [
                        'icon' => 'bi bi-box-seam',
                        'title' => 'Hírlevél',
                        'route' => '',
                        'children' => []
                    ],
                    'form' => [
                        'icon' => 'bi bi-cart4',
                        'title' => 'Űrlapok',
                        'route' => '',
                        'children' => []
                    ],
                    'automatics' => [
                        'icon' => 'bi bi-file-earmark-text',
                        'title' => 'Automatizmusok',
                        'route' => '',
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
                        'route' => '',
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
                        'route' => 'admin_v1_domains',
                        'children' => []
                    ],
                    'website' => [
                        'icon' => 'bi bi-globe',
                        'title' => 'Honlap',
                        'route' => '',
                        'children' => []
                    ],
                    'webshop' => [
                        'icon' => 'bi bi-cart',
                        'title' => 'Webshop',
                        'route' => '',
                        'children' => []
                    ],
                    'webapp' => [
                        'icon' => 'bi bi-window',
                        'title' => 'Webalkalmazás',
                        'route' => '',
                        'children' => []
                    ],
                    'mobilapp' => [
                        'icon' => 'bi bi-phone',
                        'title' => 'Mobil alkalmazás',
                        'route' => '',
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
                        'route' => '',
                        'children' => []
                    ],
                    'website' => [
                        'icon' => 'bi bi-bag-x',
                        'title' => 'Elhagyott kosarak',
                        'route' => '',
                        'children' => []
                    ],
                    'webshop' => [
                        'icon' => 'bi bi-basket',
                        'title' => 'Vásárlások',
                        'route' => '',
                        'children' => []
                    ],
                    'payment' => [
                        'icon' => 'bi bi-credit-card',
                        'title' => 'Fizetési módok',
                        'route' => '',
                        'children' => []
                    ],
                    'shipping' => [
                        'icon' => 'bi bi-truck',
                        'title' => 'Szállítási módok',
                        'route' => '',
                        'children' => []
                    ],
                    'analytics' => [
                        'icon' => 'bi bi-bar-chart',
                        'title' => 'Analitika',
                        'route' => '',
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
                        'route' => '',
                        'children' => []
                    ],
                    'link' => [
                        'icon' => 'bi bi-link-45deg',
                        'title' => 'Link rövidítés',
                        'route' => '',
                        'children' => []
                    ],
                    'exportimport' => [
                        'icon' => 'bi bi-arrow-down-up',
                        'title' => 'Export/import',
                        'route' => '',
                        'children' => []
                    ],
                ]
            ],
        ];
    }
}
