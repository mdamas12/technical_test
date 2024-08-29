<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\OrdersController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/orders/success/{id}', [OrdersController::class, 'success'])->name('orders.success'); 
    Route::get('/orders/checkoutcancel/{id}', [OrdersController::class, 'cancelcheckout'])->name('orders.cancelcheckout'); 
    Route::resource('orders', OrdersController::class); // rutas para ordenes
    Route::post('/orders/checkout', [OrdersController::class, 'checkout'])->name('checkout'); 
    
});
