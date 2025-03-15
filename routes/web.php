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
Route::get('/', function () {
    return view('welcome');
});



//Paineis ADM
Route::get('/painelAdm', function () {
    return view('painelAdm');
})->middleware('auth:admin')->name('painelAdm');

//Painel ADM Usuario
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

//Painel ADM Administrador
Route::get('/admAdministradores', [UsersController::class, 'index'])
    ->middleware('auth:admin')
    ->name('admAdministradores');

Route::post('/admAdministrador', [UsersController::class, 'store'])
    ->middleware('auth:admin')
    ->name('createAdministrador');

Route::put('admAdministrador/{admin}', [UsersController::class, 'update'])
    ->middleware('auth:admin')
    ->name('updateAdministrador');

Route::delete('admAdministrador/{admin}', [UsersController::class, 'destroy'])
    ->middleware('auth:admin')
    ->name('deleteAdministrador');

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
Route::get('/historico-compras', [MovimentacoesController::class, 'index'])
    ->middleware('auth')
    ->name('historico-compras');

//Historico de Vendas
Route::get('/historicoDeVendas', function () {
    return view('historicoDeVendas');
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
});

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

//Criar Produto
Route::get('/admProdutos', [ProductController::class, 'index'])
    ->middleware('auth')
    ->name('admProdutos');

Route::post('/criarproduto', [ProductController::class, 'store'])
    ->name('criarproduto');



require __DIR__.'/auth.php';