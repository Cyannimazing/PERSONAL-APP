<?php

use Illuminate\Support\Facades\Route;

// Public routes
require __DIR__ . '/public.php';

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
	require __DIR__ . '/auth.php';
	require __DIR__ . '/user.php';
	require __DIR__ . '/admin.php';
});
