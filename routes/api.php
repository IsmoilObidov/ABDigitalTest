<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QueryController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/articles', ArticleController::class);
});

Route::resource('/articles', ArticleController::class)->only(['index']);


Route::get('/slow-query', [QueryController::class, 'slowQuery'])->name('slow-query');
Route::get('/fast-query', [QueryController::class, 'optimizedQuery'])->name('fast-query');
