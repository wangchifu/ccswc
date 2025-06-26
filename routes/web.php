<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\OpenIDController;
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
Route::get('show/{post}', [HomeController::class, 'show'])->name('show');

//gsuite登入
Route::get('mlogin', [LoginController::class, 'mlogin'])->name('mlogin');
Route::get('login', [LoginController::class, 'login'])->name('login');

//openid登入
Route::get('sso', [OpenIDController::class,'sso'])->name('sso');
Route::get('auth/callback', [OpenIDController::class,'callback'])->name('callback');

Route::post('auth', [LoginController::class, 'auth'])->name('auth');

//認證圖片
Route::get('pic/{d?}', [HomeController::class, 'pic'])->name('pic');

/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/

Route::get('posts/view', [PostsController::class, 'posts_view'])->name('posts.view');
Route::get('history/view', [HomeController::class, 'history_view'])->name('history.view');
Route::get('community/view', [HomeController::class, 'community_view'])->name('community.view');
Route::get('community/show/{code}', [HomeController::class, 'community_show'])->name('community.show');
Route::get('law/view', [HomeController::class, 'law_view'])->name('law.view');
Route::get('resource/view', [HomeController::class, 'resource_view'])->name('resource.view');

Route::get('courses/index/{code?}', [DataController::class, 'course_index'])->name('courses.index');
Route::get('staffs/index/{code?}', [DataController::class, 'staff_index'])->name('staffs.index');
Route::get('teachers/index/{code?}', [DataController::class, 'teacher_index'])->name('teachers.index');
Route::get('students/index', [DataController::class, 'student_index'])->name('students.index');


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

    Route::get('courses/create', [DataController::class, 'course_create'])->name('courses.create');
    Route::post('courses/store', [DataController::class, 'course_store'])->name('courses.store');
    Route::get('courses/create_one/{course_season}', [DataController::class, 'course_create_one'])->name('courses.create_one');
    Route::post('courses/store_one', [DataController::class, 'course_store_one'])->name('courses.store_one');
    Route::get('courses/edit_one/{course}', [DataController::class, 'course_edit_one'])->name('courses.edit_one');
    Route::patch('courses/update_one/{course}', [DataController::class, 'course_update_one'])->name('courses.update_one');
    Route::get('courses/delete_one/{course}', [DataController::class, 'course_delete_one'])->name('courses.delete_one');

    Route::get('staffs/create', [DataController::class, 'staff_create'])->name('staffs.create');
    Route::post('staffs/store', [DataController::class, 'staff_store'])->name('staffs.store');
    Route::get('staffs/create_one/{staff_season}', [DataController::class, 'staff_create_one'])->name('staffs.create_one');
    Route::post('staffs/store_one', [DataController::class, 'staff_store_one'])->name('staffs.store_one');
    Route::get('staffs/edit_one/{staff}', [DataController::class, 'staff_edit_one'])->name('staffs.edit_one');
    Route::patch('staffs/update_one/{staff}', [DataController::class, 'staff_update_one'])->name('staffs.update_one');
    Route::get('staffs/delete_one/{staff}', [DataController::class, 'staff_delete_one'])->name('staffs.delete_one');

    Route::get('teachers/create', [DataController::class, 'teacher_create'])->name('teachers.create');
    Route::post('teachers/store', [DataController::class, 'teacher_store'])->name('teachers.store');
    Route::get('teachers/create_one/{teacher_season}', [DataController::class, 'teacher_create_one'])->name('teachers.create_one');
    Route::post('teachers/store_one', [DataController::class, 'teacher_store_one'])->name('teachers.store_one');
    Route::get('teachers/edit_one/{teacher}', [DataController::class, 'teacher_edit_one'])->name('teachers.edit_one');
    Route::patch('teachers/update_one/{teacher}', [DataController::class, 'teacher_update_one'])->name('teachers.update_one');
    Route::get('teachers/delete_one/{teacher}', [DataController::class, 'teacher_delete_one'])->name('teachers.delete_one');

    Route::get('students/create', [DataController::class, 'student_create'])->name('students.create');
    Route::post('students/store', [DataController::class, 'student_store'])->name('students.store');
    Route::get('students/edit/{student}', [DataController::class, 'student_edit'])->name('students.edit');
    Route::patch('students/update/{student}', [DataController::class, 'student_update'])->name('students.update');
    Route::get('students/delete/{student}', [DataController::class, 'student_delete'])->name('students.delete');

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

    Route::get('title_image', [HomeController::class, 'title_image'])->name('title_image');
    Route::post('title_image/store', [HomeController::class, 'title_image_store'])->name('title_image_store');
    Route::get('title_image/delete', [HomeController::class, 'title_image_delete'])->name('title_image_delete');
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
    Route::get('reports/{report}/download_excel', [ReportsController::class, 'download_excel'])->name('reports.download_excel');

    Route::get('law/create', [HomeController::class, 'law_create'])->name('law.create');
    Route::post('law/store', [HomeController::class, 'law_store'])->name('law.store');
    Route::get('law/edit/{content}', [HomeController::class, 'law_edit'])->name('law.edit');
    Route::patch('law/update/{content}', [HomeController::class, 'law_update'])->name('law.update');
    Route::get('law/delete/{content}', [HomeController::class, 'law_delete'])->name('law.delete');

    Route::get('resource/create', [HomeController::class, 'resource_create'])->name('resource.create');
    Route::post('resource/store', [HomeController::class, 'resource_store'])->name('resource.store');
    Route::get('resource/edit/{content}', [HomeController::class, 'resource_edit'])->name('resource.edit');
    Route::patch('resource/update/{content}', [HomeController::class, 'resource_update'])->name('resource.update');
    Route::get('resource/delete/{content}', [HomeController::class, 'resource_delete'])->name('resource.delete');
});

//社教科人員及社大的管理
Route::group(['middleware' => 'social_education_school_admin'], function () {
    Route::get('history/edit', [HomeController::class, 'history_edit'])->name('history.edit');
    Route::post('history/store', [HomeController::class, 'history_store'])->name('history.store');
    Route::get('community/edit/{code}', [HomeController::class, 'community_edit'])->name('community.edit');
    Route::post('community/store', [HomeController::class, 'community_store'])->name('community.store');
});
