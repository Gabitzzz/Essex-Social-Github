<?php

use App\Http\Controllers\LikedPostsController;
use App\Http\Controllers\PostsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});





Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware('auth')->name('dashboard');

//  POSTS
Route::get('/home', [\App\Http\Controllers\PostsController::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::get('create-post', [PostsController::class, 'create'])
    ->middleware('auth')
    ->name('posts.create');


Route::post('add', [PostsController::class, 'store'])
    ->middleware('auth')
    ->name('posts.store');


//  USERS
Route::get('/users/{user:username}', [\App\Http\Controllers\UsersController::class, 'index'])
    ->name('profile')
    ->middleware('auth');

Route::get('users/{user:username}/edit', [\App\Http\Controllers\UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [\App\Http\Controllers\UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::get('/explore', [\App\Http\Controllers\UsersController::class, 'explore'])
    ->name('explore')
    ->middleware('auth');

Route::get('/search', [\App\Http\Controllers\UsersController::class, 'search'])
    ->name('search')
    ->middleware('auth');

//      FOLLOW
Route::get('/users/{user:username}/followings', [\App\Http\Controllers\FollowingController::class, 'index'])
    ->name('followings')
    ->middleware('auth');

Route::post('/users/{user:username}/followings/{id}', [\App\Http\Controllers\FollowingController::class, 'store'])
    ->name('followings.store')
    ->middleware('auth');


Route::delete('/users/{user:username}/followings/{id}', [\App\Http\Controllers\FollowingController::class, 'destroy'])
    ->name('followings.delete')
    ->middleware('auth');


Route::get('/users/{user:username}/followers', [\App\Http\Controllers\FollowersController::class, 'index'])
    ->name('followers')
    ->middleware('auth');


Route::get('/users/{user:username}/followers/{id}', [\App\Http\Controllers\FollowersController::class, 'store'])
    ->name('followers.store')
    ->middleware('auth');

Route::delete('/users/{user:username}/followers/{id}', [\App\Http\Controllers\FollowersController::class, 'destroy'])
    ->name('followers.delete')
    ->middleware('auth');

//  LIKE
Route::prefix('post-like')->name('post-like.')->group(function (){
    Route::post('/{post}', [\App\Http\Controllers\PostLikeController::class, 'store'])
        ->name('store');

    Route::delete('/{post}/delete', [\App\Http\Controllers\PostLikeController::class, 'destroy'])
        ->name('destroy');
});


require __DIR__ . '/auth.php';
