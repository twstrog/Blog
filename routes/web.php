<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\FrontendController;

Route::get('/', function () {
    return view('welcome');
});

// Route Frontend Manage
Route::get('/', [FrontendController::class, 'index']);
Route::prefix('category')->group(function () {
    Route::get('/{category_slug}', [FrontendController::class, 'viewCategoryPost']);
    Route::get('/{category_slug}/{post_slug}', [FrontendController::class, 'viewPost']);
});

// Route Super Admin Manage
Route::middleware(['auth', 'isSuperAdmin'])->group(function () {
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('admin/users/{user_id}', [UserController::class, 'edit'])->name('admin.edit-user');
    Route::put('admin/update-role/{user_id}', [UserController::class, 'update']);
    Route::get('/delete-user/{user_id}', [UserController::class, 'destroy']);
    // Route::get('admin/users', [UserController::class, 'lastActive'])->name('active-users');
});

// Route Admin Manage
Route::prefix('admin')->middleware('auth', 'adminOrSuperAdmin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [DashboardController::class, 'edit'])->name('admin.profile');
    Route::post('/profile', [DashboardController::class, 'update'])->name('admin.profile.update');

    Route::get('/tools', [DashboardController::class, 'tools'])->name('admin.tools');

    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/add-category', [CategoryController::class, 'create'])->name('admin.add-category');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('admin.add-category');
    Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit'])->name('admin.edit-category');
    Route::put('/edit-category/{category_id}', [CategoryController::class, 'update'])->name('admin.update-category');
    Route::get('/delete-category/{category_id}', [CategoryController::class, 'destroy'])->name('admin.delete-category');
    // Route::post('/delete-category', [CategoryController::class, 'destroy'])->name('admin.delete-category');

    Route::get('/posts', [PostController::class, 'index'])->name('admin.post');
    Route::get('/add-post', [PostController::class, 'create'])->name('admin.add-post');
    Route::post('/add-post', [PostController::class, 'store'])->name('admin.add-post');
    Route::get('/post/{post_id}', [PostController::class, 'edit']);
    Route::put('/update-post/{post_id}', [PostController::class, 'update']);
    Route::get('/delete-post/{post_id}', [PostController::class, 'destroy']);
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('auth.profile');
    Route::post('/profile', [DashboardController::class, 'update'])->name('auth.profile.update');
    Route::get('/password/change', [PasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [PasswordController::class, 'changePassword'])->name('password.update');
});

// Comment Route
Route::post('comments', [CommentController::class, 'store']);
Route::post('/delete-comment', [CommentController::class, 'destroy']);
// Route::get('/edit-comment/{comment_id}', [CommentController::class, 'edit']);
// Route::put('/update-comment/{comment_id}', [CommentController::class, 'update']);
