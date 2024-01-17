<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest', 'caffeinated')
    ->group(function () {
        Route::get('/login', Login::class)
            ->name('login');
        Route::get('/register', Register::class)
            ->name('register');
    });

Route::middleware('guest')
    ->group(function () {
        Route::post('/logout', Login::class)
            ->name('logout');
    });

require_once('web/frontend.php');
require_once('web/backend.php');
