<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/apps', [AdminController::class, 'apps']);
    Route::post('/grant', [AdminController::class, 'grant']);
    Route::post('/revoke', [AdminController::class, 'revoke']);
});
