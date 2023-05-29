<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;


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

// Autenticação
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/logar', [UserController::class, 'logar'])->name('logar');

Route::get('/login/form', [UserController::class, 'loginForm'])->name('loginForm');
Route::post('/login/register', [UserController::class, 'register'])->name('register');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// perfil
Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/perfil/atualizar', [ProfileController::class, 'update'])->name('profile.update');
