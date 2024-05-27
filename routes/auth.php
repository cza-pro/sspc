<?php

use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\AuthenticatedController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('register', [RegisterController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisterController::class, 'store']);

    Route::get('login', [AuthenticatedController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedController::class, 'store']);

});
