<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
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
Route::get('create_admin', [HomeController::class, 'create_admin'])->name('create_admin');

Route::get('/', [HomeController::class, 'index'])->name('index');

//gsuite登入
Route::get('g_login', [LoginController::class, 'g_login'])->name('g_login');
Route::get('login', [LoginController::class, 'login'])->name('login');

Route::post('auth', [LoginController::class, 'auth'])->name('auth');

//認證圖片
Route::get('pic/{d?}', [HomeController::class, 'pic'])->name('pic');

/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/

Route::group(['middleware' => 'auth'], function () {
    //登出
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('users/reset_pwd', [UsersController::class, 'reset_pwd'])->name('users.reset_pwd');
    Route::patch('users/update_pwd', [UsersController::class, 'update_pwd'])->name('users.update_pwd');

    //結束模擬
    Route::get('sims/impersonate_leave', [HomeController::class, 'impersonate_leave'])->name('sims.impersonate_leave');
});

Route::group(['middleware' => 'admin'], function () {
    //模擬登入
    Route::get('sims/{user}/impersonate', [HomeController::class, 'impersonate'])->name('sims.impersonate');
    Route::get('users/index', [UsersController::class, 'index'])->name('users.index');
    Route::get('users/index2', [UsersController::class, 'index2'])->name('users.index2');
    Route::patch('users/social_education', [UsersController::class, 'social_education'])->name('users.social_education');

    Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('users/{user}/update', [UsersController::class, 'update'])->name('users.update');
    Route::get('users/{user}/delete', [UsersController::class, 'delete'])->name('users.delete');
    Route::get('users/{user}/able', [UsersController::class, 'able'])->name('users.able');
    Route::get('users/{user}/back_pwd', [UsersController::class, 'back_pwd'])->name('users.back_pwd');
    
});

Route::group(['middleware' => 'school_admin'], function () {
    Route::get('users/school_index', [UsersController::class, 'school_index'])->name('users.school_index');
    Route::get('users/{user}/school_edit', [UsersController::class, 'school_edit'])->name('users.school_edit');
    Route::patch('users/{user}/school_update', [UsersController::class, 'school_update'])->name('users.school_update');
    Route::get('users/{user}/school_able', [UsersController::class, 'school_able'])->name('users.school_able');

});


Route::group(['middleware' => 'all_admin'], function () {

});



Route::group(['middleware' => 'section'], function () {
    Route::get('apply_section', [UsersController::class, 'apply_section'])->name('users.apply_section');
});

Route::group(['middleware' => 'social_education'], function () {
});