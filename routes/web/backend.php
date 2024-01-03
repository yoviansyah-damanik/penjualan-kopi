<?php

use Illuminate\Support\Facades\Route;


Route::as('dashboard.')
    ->prefix('dashboard')
    ->middleware(['auth', 'role:Administrator'])
    ->group(function () {
        // Dashboard
        Route::get('/', App\Livewire\Backend\Home\Index::class)
            ->name('home');

        // Product
        Route::get('/product', App\Livewire\Backend\Product\Index::class)
            ->name('product');
        Route::get('/product/create', App\Livewire\Backend\Product\Create::class)
            ->name('product.create');
        Route::get('/product/edit/{products:id}', App\Livewire\Backend\Product\Edit::class)
            ->name('product.edit');

        // Category
        Route::get('/category', App\Livewire\Backend\Category\Index::class)
            ->name('category');
        Route::get('/category/create', App\Livewire\Backend\Category\Create::class)
            ->name('category.create');
        Route::get('/category/edit/{categories:id}', App\Livewire\Backend\Category\Edit::class)
            ->name('category.edit');

        // Payment Vendor
        Route::get('/payment-vendor', App\Livewire\Backend\PaymentVendor\Index::class)
            ->name('payment-vendor');
        Route::get('/payment-vendor/create', App\Livewire\Backend\PaymentVendor\Create::class)
            ->name('payment-vendor.create');
        Route::get('/payment-vendor/edit/{categories:id}', App\Livewire\Backend\PaymentVendor\Edit::class)
            ->name('payment-vendor.edit');

        // Transaction
        Route::get('/transaction', App\Livewire\Backend\Transaction\Index::class)
            ->name('transaction');
        Route::get('/transaction/show/{id}', App\Livewire\Backend\Transaction\Show\Index::class)
            ->name('transaction.show');
        Route::get('/transaction/{type}', App\Livewire\Backend\Transaction\Type::class)
            ->name('transaction.type');

        // Configuration
        Route::get('/user', App\Livewire\Backend\Configuration\User\Index::class)
            ->name('configuration.user');
        Route::get('/account', App\Livewire\Backend\Configuration\Account\Index::class)
            ->name('configuration.account');

        // Report
        Route::get('/report/income', App\Livewire\Backend\Report\Income\Index::class)
            ->name('report.income');
        Route::get('/report/sales', App\Livewire\Backend\Report\Sales\Index::class)
            ->name('report.sales');
        Route::get('/report/transaction', App\Livewire\Backend\Report\Transaction\Index::class)
            ->name('report.transaction');
    });
