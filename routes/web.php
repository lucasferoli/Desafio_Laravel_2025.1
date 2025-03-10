<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/painelAdm', function () {
    return view('painelAdm');
})->middleware('auth:admin')->name('painelAdm');

 
Route::get('/historicoDeCompras', function () {
    return view('historicoDeCompras');
});

Route::get('/paginaDeProduto', function () {
    return view('paginaDeProduto');
});

Route::get('/adicionarProduto', function () {
    return view('adicionarProduto');
});


Route::get('/paginaDoPerfil', function () {
    return view('paginaDoPerfil');
});


Route::get('/random-product', [ProductController::class, 'showRandomProduct']);

Route::get('/product/details/{id}', [ProductController::class, 'showDetails'])->name('product.details');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';