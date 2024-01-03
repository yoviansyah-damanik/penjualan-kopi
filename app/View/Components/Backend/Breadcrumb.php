<?php

namespace App\View\Components\Backend;

use Closure;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class Breadcrumb extends Component
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
        $segments = collect(request()
            ->segments())
            ->map(function ($q, $key) {
                if ($key == collect(request()
                    ->segments())->count() - 1)
                    return [
                        'title' => base64_encode(base64_decode($q)) === $q ? base64_decode($q) : __(Str::headline($q)),
                        'is_active' => false,
                        'uri' => '#',
                    ];

                return [
                    'title' => base64_encode(base64_decode($q)) === $q ? base64_decode($q) : __(Str::headline($q)),
                    'is_active' => $q == 'dashboard' || ($q != 'dashboard' && Route::has('dashboard.' . $q)) ? true : false,
                    'uri' =>  $q == 'dashboard' ? route('dashboard.home') : ($q != 'dashboard' && Route::has('dashboard.' . $q) ? route('dashboard.' . $q) : '#'),
                ];
            });

        return view('components.backend.breadcrumb', compact('segments'));
    }
}
