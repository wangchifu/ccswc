<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
//建立管理者
Route::get('/create_admin', [HomeController::class, 'create_admin'])->name('create_admin');

Route::get('/', [HomeController::class, 'index'])->name('index');

//gsuite登入
Route::get('g_login', [LoginController::class, 'g_login'])->name('g_login');
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('auth', [LoginController::class, 'auth'])->name('auth');

//認證圖片
Route::get('pic/{d?}', [HomeController::class, 'pic'])->name('pic');

/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/
