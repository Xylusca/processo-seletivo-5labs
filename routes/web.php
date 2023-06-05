<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ProductController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// User
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/logar', [UserController::class, 'logar'])->name('logar');
Route::get('/login/form', [UserController::class, 'loginForm'])->name('loginForm');
Route::post('/login/register', [UserController::class, 'register'])->name('register');

// Esqueci Senha
Route::get('/reset/form', [ForgotPasswordController::class, 'resetPassword'])->name('reset.form');
Route::post('/reset/enviar', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('reset.enviar');

// Restaurar Senha
Route::get('/password/reset/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('reset.password');
Route::post('/password/register/', [ResetPasswordController::class, 'resetPassword'])->name('register.password');


// Produto
Route::get('/produto/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/produto/comprar', [ProductController::class, 'purchase'])->name('product.purchase');

// Restaurar Importar Produtos da Api
Route::get('/import-products', [ProductController::class, 'importProducts']);

// Rotas para usuários de nível 1 ou superior
Route::middleware('check.nivel_id:1')->group(function () {
    // Sair da conta
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // Perfil
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/perfil/atualizar', [ProfileController::class, 'update'])->name('profile.update');

    // Verificar E-mail
    Route::get('/email/enviar', [VerificationController::class, 'enviarEmailVerificacao'])->name('email.enviar');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('email.verify');

    // Consultar Compras
    Route::get('/minhas_compras', [ProductController::class, 'myPurchases'])->name('purchases');
});


// Rotas para usuários de nível 2 ou superior
Route::middleware('check.nivel_id:2')->group(function () {
    Route::get('/product/editar/{id}', [ProductController::class, 'productEdit'])->name('product.edit');
    Route::post('/product/atualizar/{id}', [ProductController::class, 'productUpdate'])->name('product.update');
    Route::get('/product/form', [ProductController::class, 'productForm'])->name('product.form');
    Route::post('/product/register', [ProductController::class, 'productRegister'])->name('product.register');
    Route::get('/minhas_vendas', [ProductController::class, 'sales'])->name('sales');
    Route::get('/meus_produtos', [ProductController::class, 'myProduct'])->name('myProduct');
});

// Rotas para usuários de nível 3 ou superior
Route::middleware('check.nivel_id:3')->group(function () {
    Route::get('/usuarios', [UserController::class, 'consulta'])->name('usuarios');
    Route::put('/usuarios/{id}/status', [UserController::class, 'atualizarStatus'])->name('atualizarStatus');
});
