<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth.check'])->group(function () {
    Route::get('/produk', [ProductController::class, 'index']);
    Route::get('/produk/create', [ProductController::class, 'create']);
    Route::post('/produk', [ProductController::class, 'store']);
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/produk/{id}', [ProductController::class, 'update']);
    Route::delete('/produk/{id}', [ProductController::class, 'destroy']);

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

});

