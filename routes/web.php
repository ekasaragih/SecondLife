<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Authorization
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages/explore');
});

Route::get('/login', [AuthorizationController::class, 'login'])->name('login');
Route::post('/auth_authenticate',  [AuthorizationController::class, 'authenticate'])->name('auth_authenticate');
Route::get('/register', [AuthorizationController::class, 'register'])->name('register');
Route::post('/auth_store', [AuthorizationController::class, 'store'])->name('auth_store');
Route::get('/register-optional', [AuthorizationController::class, 'registerSkip'])->name('registerSkip');
Route::post('/register', [AuthorizationController::class, 'storeSkip'])->name('auth_storeSkip');

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/
Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/communities', [PageController::class, 'communities'])->name('communities');

Route::get('/profile', [PageController::class, 'my_profile'])->name('my_profile');
Route::get('/wishlist', [PageController::class, 'wishlist'])->name('wishlist');

Route::get('/contact-us', [PageController::class, 'contact_us'])->name('contact_us');
Route::get('/privacy-policy', [PageController::class, 'privacy_policy'])->name('privacy_policy');

Route::get('/my-goods', [PageController::class, 'my_goods'])->name('my_goods');
Route::get('/chat', [ChatController::class, 'index'])->name('home_chat');




/*
|--------------------------------------------------------------------------
| Error Pages
|--------------------------------------------------------------------------
*/
Route::get('/404-not-found', [PageController::class, 'not_found'])->name('not_found');
Route::get('/500-server-error', [PageController::class, 'internal_server_error'])->name('internal_server_error');






/*
|--------------------------------------------------------------------------
| Post & Get Functions
|--------------------------------------------------------------------------
*/