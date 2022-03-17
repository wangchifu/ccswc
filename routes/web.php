<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ReportsController;
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

//會員可
Route::group(['middleware' => 'auth'], function () {
    //登出
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('users/reset_pwd', [UsersController::class, 'reset_pwd'])->name('users.reset_pwd');
    Route::patch('users/update_pwd', [UsersController::class, 'update_pwd'])->name('users.update_pwd');

    Route::get('posts/school_index', [PostsController::class, 'school_index'])->name('posts.school_index');
    Route::get('posts/{post}/school_show', [PostsController::class, 'school_show'])->name('posts.school_show');
    Route::get('posts/{post_school}/school_sign', [PostsController::class, 'school_sign'])->name('posts.school_sign');

    Route::get('reports/school_index', [ReportsController::class, 'school_index'])->name('reports.school_index');
    Route::get('reports/{report}/school_show', [ReportsController::class, 'school_show'])->name('reports.school_show');
    Route::post('reports/{report_school}/school_sign', [ReportsController::class, 'school_sign'])->name('reports.school_sign');
    Route::get('reports/{report}/school_edit', [ReportsController::class, 'school_edit'])->name('reports.school_edit');
    Route::post('reports/{report_school}/school_update', [ReportsController::class, 'school_update'])->name('reports.school_update');    
    Route::get('reports/{report}/school_view', [ReportsController::class, 'school_view'])->name('reports.school_view');


    //結束模擬
    Route::get('sims/impersonate_leave', [HomeController::class, 'impersonate_leave'])->name('sims.impersonate_leave');
});

//系統管理者可
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

//社大管理者可
Route::group(['middleware' => 'school_admin'], function () {
    Route::get('users/school_index', [UsersController::class, 'school_index'])->name('users.school_index');
    Route::get('users/{user}/school_edit', [UsersController::class, 'school_edit'])->name('users.school_edit');
    Route::patch('users/{user}/school_update', [UsersController::class, 'school_update'])->name('users.school_update');
    Route::get('users/{user}/school_able', [UsersController::class, 'school_able'])->name('users.school_able');
    
    Route::get('reports/{report_school}/school_pass', [ReportsController::class, 'school_pass'])->name('reports.school_pass');
    Route::get('reports/{report_school}/school_back', [ReportsController::class, 'school_back'])->name('reports.school_back');

});

//社教科管理者 及 社大管理者可
Route::group(['middleware' => 'all_admin'], function () {

});

//社教科管理者可
Route::group(['middleware' => 'social_education_admin'], function () {
    Route::get('posts/review', [PostsController::class, 'review'])->name('posts.review');
    Route::get('posts/{post}/pass', [PostsController::class, 'pass'])->name('posts.pass');
    Route::get('posts/{post}/back', [PostsController::class, 'back'])->name('posts.back');

    Route::get('reports/review', [ReportsController::class, 'review'])->name('reports.review');
    Route::get('reports/{report}/pass', [ReportsController::class, 'pass'])->name('reports.pass');
    Route::get('reports/{report}/back', [ReportsController::class, 'back'])->name('reports.back');
});


//教育處人員可
Route::group(['middleware' => 'section'], function () {
    Route::get('apply_section', [UsersController::class, 'apply_section'])->name('users.apply_section');
});


//社教科人員可
Route::group(['middleware' => 'social_education'], function () {
    Route::get('posts/index', [PostsController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('posts/store', [PostsController::class, 'store'])->name('posts.store');
    Route::get('posts/{post}/show', [PostsController::class, 'show'])->name('posts.show');
    Route::get('posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::get('posts/{post_id}/delete_file/{filename}', [PostsController::class, 'delete_file'])->name('posts.delete_file');
    Route::patch('posts/{post}/update', [PostsController::class, 'update'])->name('posts.update');
    Route::get('posts/{post}/delete', [PostsController::class, 'delete'])->name('posts.delete');
    Route::get('posts/{post}/trash', [PostsController::class, 'trash'])->name('posts.trash');

    Route::get('reports/index', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('reports/create', [ReportsController::class, 'create'])->name('reports.create');
    Route::post('reports/store', [ReportsController::class, 'store'])->name('reports.store');
    Route::get('reports/{report}/show', [ReportsController::class, 'show'])->name('reports.show');
    Route::get('reports/{report}/edit', [ReportsController::class, 'edit'])->name('reports.edit');
    Route::get('reports/{report_id}/delete_file/{filename}', [ReportsController::class, 'delete_file'])->name('reports.delete_file');
    Route::patch('reports/{report}/update', [ReportsController::class, 'update'])->name('reports.update');

    Route::get('reports/{report}/delete', [ReportsController::class, 'delete'])->name('reports.delete');
    Route::get('reports/{report}/trash', [ReportsController::class, 'trash'])->name('reports.trash');
    Route::get('reports/{report}/excel', [ReportsController::class, 'excel'])->name('reports.excel');
});