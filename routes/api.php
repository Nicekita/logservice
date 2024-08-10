<?php

use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::post('/log', [LogController::class, 'logService']);
