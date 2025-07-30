<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {

    Route::get('order-list', [OrderController::class, 'list'])->name('orders.list');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('new-order', [OrderController::class, 'create'])->name('orders.create');

});

require __DIR__.'/auth.php';
