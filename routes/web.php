<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SacarController;
use App\Http\Controllers\ProdutoCarrinhoController;
use App\Http\Controllers\ContactController;


//Home
Route::get('/', function () {
    return view('welcome');
});



//Paineis ADM
Route::get('/painelAdm', function () {
    return view('painelAdm');
})->middleware('auth:admin')->name('painelAdm');

Route::get('/admUsuarios', [UsersController::class, 'index'])
    ->middleware('auth:admin')
    ->name('admUsuarios');

Route::post('/admUsuario', [UsersController::class, 'store'])
    ->middleware('auth:admin')
    ->name('createUser');

Route::put('admUsuario/{user}', [UsersController::class, 'update'])
    ->middleware('auth:admin')
    ->name('updateUser');

Route::delete('admUsuario/{user}', [UsersController::class, 'destroy'])
    ->middleware('auth:admin')
    ->name('deleteUser');

Route::get('/admAdministrador', function () {
    return view('admAdministrador');
})->middleware('auth:admin')->name('admAdministrador');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('usuarioEditar');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('usuarioUpdate');
    Route::delete('/user/profile', [ProfileController::class, 'delete'])->name('usuarioDelete');
});



//Pagina de Saque
Route::get('/paginaDeSaque', function () {
        return view('paginaDeSaque');
    })->middleware('auth')->name('paginaDeSaque');


Route::post('/sacar', [SacarController::class, 'sacar'])->name('sacar')->middleware('auth');


//Historico De Compras
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

// Carrinho
Route::match(['get', 'post'], '/checkout', function () {
    return view('checkout');
})->middleware('auth')->name('checkout');

Route::get('/random-product', [ProductController::class, 'showRandomProduct']);

Route::get('/product/details/{id}', [ProductController::class, 'showDetails'])->name('product.details');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

//Rotas para mandar e-mail
Route::middleware('auth:admin')->group(function () {
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

//Dashboard
Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

//Editar proprio perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';