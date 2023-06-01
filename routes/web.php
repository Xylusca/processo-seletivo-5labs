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

// Login
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/logar', [UserController::class, 'logar'])->name('logar');
Route::get('/login/form', [UserController::class, 'loginForm'])->name('loginForm');
Route::post('/login/register', [UserController::class, 'register'])->name('register');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Perfil
Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/perfil/atualizar', [ProfileController::class, 'update'])->name('profile.update');

// Verificar E-mail
Route::get('/email/enviar', [VerificationController::class, 'enviarEmailVerificacao'])->name('email.enviar');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('email.verify');


// Esqueci Senha
Route::get('/reset/form', [ForgotPasswordController::class, 'resetPassword'])->name('reset.form');
Route::post('/reset/enviar', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('reset.enviar');

// Restaurar Senha
Route::get('/password/reset/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('reset.password');
Route::post('/password/register/', [ResetPasswordController::class, 'resetPassword'])->name('register.password');


// Produto
Route::get('/produto/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/produto/comprar', [ProductController::class, 'purchase'])->name('product.purchase');
Route::get('/Minhas_compras', [ProductController::class, 'myPurchases'])->name('purchases');

// Restaurar Importar Produtos da Api
Route::get('/produto/import-products', [ProductController::class, 'importProducts']);
