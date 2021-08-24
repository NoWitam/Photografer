<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TopController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [UserController::class, 'startPage'])->name('start');

Route::get('/photo/{id}', [PhotoController::class, 'show'])->name('photo');

Route::POST('/action/photo/rate', [PhotoController::class, 'rate'])->name('photo.rate')->middleware('auth');

Route::POST('/action/photo/comment', [PhotoController::class, 'comment'])->name('photo.comment')->middleware('auth');

Route::POST('/action/photo/add', [PhotoController::class, 'add'])->name('photo.add')->middleware('auth');

Route::POST('/action/user/dodaj', [UserController::class, 'dodaj'])->name('user.dodaj');

Route::POST('/action/user/loguj', [UserController::class, 'loguj'])->name('user.loguj');

Route::get('/action/user/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth');

Route::POST('/action/user/unfollow', [FollowController::class, 'unfollow'])->name('user.unfollow')->middleware('auth');

Route::POST('/action/user/follow', [FollowController::class, 'follow'])->name('user.follow')->middleware('auth');

Route::get('/profil/{id}/{page}', [UserController::class, 'show'])->name('user.show');

Route::POST('/action/user/description', [UserController::class, 'description'])->name('user.description')->middleware('auth');

Route::get('/profil/dodaj', [PhotoController::class, 'addPhotoPage'])->name('photo.addPage')->middleware('auth');

Route::get('/przegladaj/{page}', [FollowController::class, 'show'])->name('przegladaj')->middleware('auth');

Route::get('/top/{daysAgo}', [TopController::class, 'show'])->name('top');

Route::get('/hashtag/{hashtag}/{page}', [HashtagController::class, 'show'])->name('#');

Route::get('/search/{ask}/{page}', [SearchController::class, 'show'])->name('search.show');

Route::get('/action/search/ask', [SearchController::class, 'ask'])->name('search.ask');