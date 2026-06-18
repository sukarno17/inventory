<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| All routes within this file are automatically prefixed with '/api'.
| Modul V: Added 'v1' prefix routing group for API versioning.
|
*/

// 1. Bungkus seluruh endpoint ke dalam Group API Versi 1
Route::prefix('v1')->group(function () {

    // -------------------------------------------------------------
    // RUTE PUBLIK (Dapat diakses tanpa login/token)
    // URL: /api/v1/register & /api/v1/login
    // -------------------------------------------------------------
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // -------------------------------------------------------------
    // RUTE TERPROTEKSI (Wajib membawa Header 'Authorization: Bearer {token}')
    // -------------------------------------------------------------
    Route::middleware('auth:sanctum')->group(function () {

        // --- Resource Kategori ---
        // URL: GET /api/v1/categories, POST /api/v1/categories, dll.
        Route::apiResource('categories', CategoryController::class)->except(['destroy']);
        
        // Khusus penghapusan kategori dibatasi hanya untuk user dengan role 'admin'
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])
            ->middleware('role:admin');


        // --- Resource Item ---
        // URL: GET /api/v1/items, POST /api/v1/items, dll.
        Route::apiResource('items', ItemController::class)->except(['destroy']);
        
        // Khusus penghapusan item dibatasi hanya untuk user dengan role 'admin'
        Route::delete('items/{item}', [ItemController::class, 'destroy'])
            ->middleware('role:admin');

    });

});