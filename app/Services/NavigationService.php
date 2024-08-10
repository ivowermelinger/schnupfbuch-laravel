<?php

namespace App\Services;

use App\Enums\Roles;
use Illuminate\Support\Collection;

class NavigationService
{
    /**
     * Get the navigation items for the application.
     *
     * @return array<int, array<string, string>>
     */
    public function getNavigationItems(): Collection
    {
        $items = collect([
            (object) [
                'name' => 'Home',
                'route' => route('home'),
                'icon' => 'planet',
                'active' => request()->routeIs('home'),
            ],
            (object) [
                'name' => 'Sprüche Management',
                'route' => route('admin.lines'),
                'icon' => 'beer',
                'active' => request()->routeIs('admin.lines'),
                'restrict' => [Roles::ADMIN],
            ],
            (object) [
                'name' => 'Deine Sprüche',
                'route' => route('settings.lines'),
                'icon' =>  'snuff',
                'active' => request()->routeIs('settings.lines'),

            ],
            (object) [
                'name' => 'Account',
                'route' =>  route('settings.index'),
                'icon' => 'settings',
                'active' => request()->routeIs('settings.index'),
            ],
            (object) [
                'name' => 'Logout',
                'route' =>  route('logout'),
                'icon' => 'logout',
                'active' => request()->routeIs('logout'),
            ]
        ]);

        return $this->filterNavigationItems($items);
    }

    private function filterNavigationItems($items): Collection
    {
        $role = auth()->user()->role ?? null;

        return $items->filter(function ($navigationItem) use ($role) {
            if (isset($navigationItem->restrict)) {
                return in_array($role, $navigationItem->restrict);
            }

            return true;
        });
    }
}
