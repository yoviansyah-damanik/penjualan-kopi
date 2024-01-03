<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Blade::component('register-header', View\Components\Auth\RegisterHeader::class);
        // Blade::component('login-header', View\Components\Auth\LoginHeader::class);
    }
}
