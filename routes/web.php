<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SacarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PagSeguroController;
use App\Http\Controllers\MovimentacoesController;


//Home
Route::get('/welcome', [ProductController::class, 'search'])->name('products.search');
// Rotas protegidas
Route::middleware(['auth:admin'])->group(function () {
    // Painel do Administrador
    Route::get('/painelAdm', function () { return view('painelAdm'); })->name('painelAdm');

    // Administrador Administradores
    Route::get('/admAdministradores', [UsersController::class, 'index'])->name('admAdministradores');
    Route::post('/admAdministrador', [UsersController::class, 'store'])->name('createAdministrador');
    Route::put('admAdministrador/{admin}', [UsersController::class, 'update'])->name('updateAdministrador');
    Route::delete('admAdministrador/{admin}', [UsersController::class, 'destroy'])->name('deleteAdministrador');
    Route::get('/admAdministrador', function () {
        return view('admAdministrador');
    })->name('admAdministrador');

    // Administrador Usuários
    Route::get('/admUsuarios', [UsersController::class, 'index'])->name('admUsuarios');
    Route::post('/admUsuario', [UsersController::class, 'store'])->name('createUser');
    Route::put('admUsuario/{user}', [UsersController::class, 'update'])->name('updateUser');
    Route::delete('admUsuario/{user}', [UsersController::class, 'destroy'])->name('deleteUser');

    // Perfil do usuário (admin)
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('usuarioEditar');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('usuarioUpdate');
    Route::delete('/user/profile', [ProfileController::class, 'delete'])->name('usuarioDelete');

    // Página de Saque e Saque
    Route::get('/paginaDeSaque', function () { return view('paginaDeSaque'); })->name('paginaDeSaque');
    Route::post('/sacar', [SacarController::class, 'sacar'])->name('sacar');

    // Histórico de Compras e PDF
    Route::get('/historico-compras', [MovimentacoesController::class, 'index'])->name('historico-compras');
    Route::get('/historico-compras-pdf', [MovimentacoesController::class, 'generatePdf'])->name('historico-compras-pdf');

    // Histórico de Vendas e PDF
    Route::get('/historico-vendas', [MovimentacoesController::class, 'indexVendas'])->name('historico-vendas');
    Route::get('/historico-vendas-pdf', [MovimentacoesController::class, 'generateVendasPdf'])->name('historico-vendas-pdf');

    // Rotas para controlar Produtos
    Route::get('/editarProdutos', [ProductController::class, 'index'])->name('editarProdutos');
    Route::post('/criarproduto', [ProductController::class, 'store'])->name('criarproduto');
    Route::put('editarProdutos/{product}', [ProductController::class, 'update'])->name('updateProduct');
    Route::delete('editarProdutos/{product}', [ProductController::class, 'destroy'])->name('deleteProduct');

    // Rotas para mandar e-mail
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    
});

// Dashboard e perfil do usuário autenticado (qualquer auth)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Paginas Aleatorias
Route::get('/paginaDeProduto', function () {
    return view('paginaDeProduto');
});
Route::get('/adicionarProduto', function () {
    return view('adicionarProduto');
});


Route::get('/paginaDoPerfil', function () {
    return view('paginaDoPerfil');
})->name('paginaDoPerfil');

// Carrinho
Route::match(['get', 'post'], '/checkout', function () {
    return view('checkout');
})->middleware('auth')->name('checkout');

Route::get('/random-product', [ProductController::class, 'showRandomProduct']);

Route::get('/product/details/{id}', [ProductController::class, 'showDetails'])->name('product.details');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/erroDePagamento', function () {
    return view('erroDePagamento');
})->name('erroDePagamento');

Route::post('/checkout', [PagSeguroController::class, 'createCheckout']);





//API de Usuarios
Route::get('/users', [UsersController::class, 'getUsers']);
Route::get('/admins', [UsersController::class, 'getAdmins']);


require __DIR__.'/auth.php';