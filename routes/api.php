<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/mostrarUser', [UserController::class, 'mostrarUser']);
Route::get('/mostrarAdmin', [AdminController::class, 'mostrarAdmin']);