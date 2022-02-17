<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikedPostsController;
use App\Http\Controllers\NotificationsController;
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


Route::delete('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

//  DASHBOARD
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


//  POSTS
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::get('create-post', [PostsController::class, 'create'])
    ->middleware('auth')
    ->name('posts.create');

Route::post('add-post', [PostsController::class, 'store'])
    ->middleware('auth')
    ->name('posts.store');

Route::get('/posts/{post}', [\App\Http\Controllers\PostsController::class, 'index'])
    ->middleware('auth')
    ->name('post.show');

Route::get('/posts/{post}/edit', [\App\Http\Controllers\PostsController::class, 'edit'])
    ->name('posts.edit')
    ->middleware('auth');

Route::put('/posts/{post}', [\App\Http\Controllers\PostsController::class, 'update'])
    ->name('posts.update')
    ->middleware('auth');

Route::get('/posts/{post}/delete', [\App\Http\Controllers\PostsController::class, 'destroy'])
    ->name('posts.destroy')
    ->middleware('auth');

// PARTIES
Route::get('create-party', [\App\Http\Controllers\PartyController::class, 'create'])
    ->middleware('auth')
    ->name('party.create');

Route::get('/parties', [\App\Http\Controllers\PartyController::class, 'index'])
    ->middleware('auth')
    ->name('party.show');

Route::post('add-party', [\App\Http\Controllers\PartyController::class, 'store'])
    ->middleware('auth')
    ->name('party.store');

Route::get('/parties/{party}', [\App\Http\Controllers\PartyController::class, 'display'])
    ->middleware('auth')
    ->name('party.item');

Route::get('/parties/{party}/edit', [\App\Http\Controllers\PartyController::class, 'edit'])
    ->name('party.edit')
    ->middleware('auth');

Route::put('/parties/{party}', [\App\Http\Controllers\PartyController::class, 'update'])
    ->name('party.update')
    ->middleware('auth');

Route::get('/parties/{party}/delete', [\App\Http\Controllers\PartyController::class, 'destroy'])
    ->name('party.destroy')
    ->middleware('auth');

//  PARTY INVITES
Route::get('/parties/{party:id}/invites', [\App\Http\Controllers\PartyInviteController::class, 'index'])
    ->name('party.invite.show')
    ->middleware('auth');

Route::post('/parties/{party:id}/invites/{id}', [\App\Http\Controllers\PartyInviteController::class, 'store'])
    ->name('party.invite.join')
    ->middleware('auth');

Route::delete('/parties/{party:id}/invites/{id}', [\App\Http\Controllers\PartyInviteController::class, 'destroy'])
    ->name('party.invite.delete')
    ->middleware('auth');


// EVENTS
Route::get('create-event', [\App\Http\Controllers\EventController::class, 'create'])
    ->middleware('auth')
    ->name('event.create');

Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])
    ->middleware('auth')
    ->name('event.show');

Route::post('add-event', [\App\Http\Controllers\EventController::class, 'store'])
    ->middleware('auth')
    ->name('event.store');

Route::get('/events/{event}', [\App\Http\Controllers\EventController::class, 'display'])
    ->middleware('auth')
    ->name('event.item');

Route::get('/events/{event}/edit', [\App\Http\Controllers\EventController::class, 'edit'])
    ->name('event.edit')
    ->middleware('auth');

Route::put('/events/{event}', [\App\Http\Controllers\EventController::class, 'update'])
    ->name('event.update')
    ->middleware('auth');

Route::get('/events/{event}/delete', [\App\Http\Controllers\EventController::class, 'destroy'])
    ->name('event.destroy')
    ->middleware('auth');

//  EVENT INVITES
Route::get('/events/{event:id}/invites', [\App\Http\Controllers\EventInviteController::class, 'index'])
    ->name('event.invite.show')
    ->middleware('auth');

Route::post('/events/{event:id}/invites/{id}', [\App\Http\Controllers\EventInviteController::class, 'store'])
    ->name('event.invite.join')
    ->middleware('auth');

Route::delete('/events/{event:id}/invites/{id}', [\App\Http\Controllers\EventInviteController::class, 'destroy'])
    ->name('event.invite.delete')
    ->middleware('auth');

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


//  LIKES
Route::post('/posts/{post}/like', [\App\Http\Controllers\PostLikeController::class, 'toggle'])
    ->middleware('auth')
    ->name('likes.toggle');

Route::post('/posts/{post}/dislike', [\App\Http\Controllers\PostDislikeController::class, 'toggle'])
    ->middleware('auth')
    ->name('dislikes.toggle');


//  COMMENTS
Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('comments.store');


//  NOTIFICATIONS
Route::get('/notifications', [\App\Http\Controllers\NotificationsController::class, 'index'])->name('notifications.show');
Route::post('/notifications/mark-one/{id}', [NotificationsController::class, 'store'])->name('notifications.store');
Route::get('/notifications/mark-all', [NotificationsController::class, 'update'])->name('notifications.update');
Route::get('/notifications/mark-delete/{id}', [NotificationsController::class, 'destroy'])->name('notifications.destroy');


require __DIR__ . '/auth.php';
