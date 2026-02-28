<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

Route::prefix('user')->group(function () {
    Route::get('/apps/available', [ApplicationController::class, 'available']);
    Route::get('/apps/my', [ApplicationController::class, 'myApps']);
    Route::post('/apps/purchase', [ApplicationController::class, 'purchase']);
});
