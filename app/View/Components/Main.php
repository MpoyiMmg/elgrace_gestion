<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Main extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menus = $this->menus();
        return view('layouts.main', [
            'menus' => $menus
        ]);
    }

    private function menus(): array {
        $route = request()->route()->getName();
        $menus = [
            (object) [
                'id' => 1,
                'title' => 'Tableau de board',
                'icon' => 'home',
                'url' => 'dashboard',
                'is_active' => $route === 'dashboard'
            ],
            (object) [
                'id' => 2,
                'title' => 'Proformats',
                'icon' => 'file-text',
                'group' => 'operations',
                'is_active' => $route === 'articles.invoices.index' || $route === 'services.invoices.index',
                'url' => 'articles.invoices.index',

                // 'submenu' => [
                //     (object) [
                //         'parent_id' => 2,
                //         'title' => 'Articles',
                //         'url' => 'articles.invoices.index',
                //         'is_active' => $route === 'articles.invoices.index' || 
                //                         $route === 'articles.invoices.create' ||
                //                         $route === 'articles.invoices.edit' ||
                //                         $route === 'articles.invoices.show'
                //     ],
                //     (object) [
                //         'parent_id' => 2,
                //         'title' => 'Services',
                //         'url' => 'services.invoices.index',
                //         'is_active' => $route === 'services.invoices.index' || 
                //                         $route === 'services.invoices.create' ||
                //                         $route === 'services.invoices.edit' ||
                //                         $route === 'services.invoices.show'
                //     ],
                // ]
            ],
            (object) [
                'id' => 3,
                'title' => 'Factures finales',
                'url' => 'final-invoices.index',
                'icon' => 'file-text',
                'is_active' => $route === 'final-invoices.index' ||
                                $route === 'final-invoices.details',
                'group' => 'operations',
            ],
            (object) [
                'id' => 4,
                'title' => 'Articles',
                'url' => 'articles.index',
                'icon' => 'box',
                'is_active' => $route === 'articles.index',
                'group' => 'apps',
                'roles' => ['admin', 'manager']
            ],
            (object) [
                'id' => 5,
                'title' => 'Services',
                'url' => 'services.index',
                'icon' => 'gift',
                'is_active' => $route === 'services.index',
                'group' => 'apps',
                'roles' => ['admin', 'manager']
            ],
            (object) [
                'id' => 6,
                'title' => 'Clients',
                'url' => 'clients.index',
                'icon' => 'users',
                'is_active' => $route === 'clients.index',
                'group' => 'apps',
                'roles' => ['admin', 'manager']
            ],
            (object) [
                'id' => 7,
                'title' => 'Modules',
                'url' => 'modules.index',
                'icon' => 'settings',
                'is_active' => $route === 'modules.index',
                'group' => 'apps',
                'roles' => ['admin', 'manager']
            ],

            (object) [
                'id' => 8,
                'title' => 'Utilisateurs',
                'url' => 'users.index',
                'icon' => 'users',
                'is_active' => $route === 'users.index',
                'group' => 'apps',
                'roles' => ['admin', 'manager']
            ]
        ];
        return $menus;
    }
}
