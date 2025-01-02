<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('myViews.dashboard');
})->name('dashboard')->middleware('ensureApiTokenExists');

# ======================================= Authentication Routes =======================================

Route::get('/login', [TestController::class, 'showLoginForm'])->name('login');
Route::post('/login', [TestController::class, 'login']);
Route::get('/register', [TestController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [TestController::class, 'register']);
Route::get('/logout', [TestController::class, 'logout'])
    ->name('logout')
    ->middleware('ensureApiTokenExists');

# ============================================= Blog Routes =============================================

Route::get('/create-blog', [BlogController::class, 'create'])
    ->name('create-blog')
    ->middleware('ensureApiTokenExists');

Route::post('/create-blog', [BlogController::class, 'store'])
    ->name('create-blog.post')
    ->middleware('ensureApiTokenExists');

Route::get('/my-blogs', [BlogController::class, 'myBlogs'])
    ->name('my-blogs')
    ->middleware('ensureApiTokenExists');

Route::get('/view-blog/{id}', [BlogController::class, 'view'])
    ->name('view-blog')
    ->middleware('ensureApiTokenExists');

Route::get('/edit-blog/{id}', [BlogController::class, 'edit'])
    ->name('edit-blog')
    ->middleware('ensureApiTokenExists');

Route::patch('/update-blog/{id}', [BlogController::class, 'update'])
    ->name('update-blog')
    ->middleware('ensureApiTokenExists');

Route::get('/edit-blog-image/{id}', [BlogController::class, 'editBlogImage'])
    ->name('edit-blog-image')
    ->middleware('ensureApiTokenExists');

Route::patch('/update-blog-image/{id}', [BlogController::class, 'updateBlogImage'])
    ->name('update-blog-image')
    ->middleware('ensureApiTokenExists');

Route::delete('/delete-blog/{id}', [BlogController::class, 'destroy'])
    ->name('delete-blog')
    ->middleware('ensureApiTokenExists');

# ============================================================================================================

Route::get('/profile', [TestController::class, 'getProfileData'])
    ->name('profile')
    ->middleware('ensureApiTokenExists');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
});
