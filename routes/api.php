<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;

// Test route to check API status
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

// Project routes
Route::get('/projects', [ProjectController::class, 'index']);
Route::post('/projects', [ProjectController::class, 'store']);

// Contact form submission route
Route::post('/contact', [ContactController::class, 'store']);
