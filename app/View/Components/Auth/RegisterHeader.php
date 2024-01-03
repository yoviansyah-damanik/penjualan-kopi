<?php

namespace App\View\Components\Auth;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RegisterHeader extends Component
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
        $navs = [
            [
                'title' => __('Home'),
                'path' => route('home'),
                'icon' => 'fas fa-house',
                'navigate' => true
            ],
            [
                'title' => __('Sign In'),
                'path' => route('login'),
                'icon' => 'fas fa-right-to-bracket',
                'navigate' => true
            ]
        ];
        return view('components.auth.register-header', compact('navs'));
    }
}
