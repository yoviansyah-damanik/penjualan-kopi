
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Frontend\Home\Index::class)
    ->name('home');
Route::get('/about', \App\Livewire\Frontend\About::class)
    ->name('about');
Route::get('/product', \App\Livewire\Frontend\Product\Index::class)
    ->name('product');
Route::get('/product/{product:slug}', \App\Livewire\Frontend\Product\Show::class)
    ->name('product.show');

Route::middleware('auth')
    ->group(function () {
        Route::get('/transaction', \App\Livewire\Frontend\Transaction\Index::class)
            ->name('transaction');

        Route::get('/profile', \App\Livewire\Frontend\Profile\Index::class)
            ->name('profile');
        Route::get('/profile/history', \App\Livewire\Frontend\Profile\History\Index::class)
            ->name('profile.history');
        Route::get('/profile/history/{id}', \App\Livewire\Frontend\Profile\History\Show::class)
            ->name('profile.history.detail');
    });
