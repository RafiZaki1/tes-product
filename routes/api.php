<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Requests\loginrequest;
use App\Http\Requests\registerrequest;
use Illuminate\Support\Facades\Cache;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store'])->middleware('checkrole:admin');
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('checkrole:admin');
    Route::post('/orders', [OrderController::class, 'store']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('checkrole:admin');
    Route::post('/logout', [AuthController::class, 'logout']);
});
