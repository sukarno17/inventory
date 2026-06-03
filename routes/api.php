<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\CategoryController;

Route::apiResource('items', ItemController::class);
Route::apiResource('categories', CategoryController::class);