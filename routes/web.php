<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [ServiceController::class, 'index'])->name('dashboard');
});
