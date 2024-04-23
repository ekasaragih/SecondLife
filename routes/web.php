<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Authorization
|--------------------------------------------------------------------------
*/


Route::get('/login', [AuthorizationController::class, 'login'])->name('login');
Route::post('/login', [AuthorizationController::class, 'authenticate']);
Route::get('/register', [AuthorizationController::class, 'register'])->name('register');
Route::post('/register', [AuthorizationController::class, 'store'])->name('auth_store');
Route::get('/register-optional', [AuthorizationController::class, 'registerSkip'])->name('registerSkip');
Route::post('/register', [AuthorizationController::class, 'storeSkip'])->name('auth_storeSkip');

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [PageController::class, 'my_profile'])->name('my_profile');
    Route::get('/wishlist', [PageController::class, 'wishlist'])->name('wishlist');
    Route::get('/my-goods', [PageController::class, 'my_goods'])->name('my_goods');
    Route::get('/chat', [ChatController::class, 'index'])->name('home_chat');
});

Route::get('/', [PageController::class, 'explore'])->name('explore');
Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/communities', [PageController::class, 'communities'])->name('communities');

Route::get('/profile', [PageController::class, 'my_profile'])->name('my_profile');
Route::get('/wishlist', [PageController::class, 'wishlist'])->name('wishlist');

Route::get('/about-us', [PageController::class, 'about_us'])->name('about_us');
Route::get('/contact-us', [PageController::class, 'contact_us'])->name('contact_us');
Route::get('/privacy-policy', [PageController::class, 'privacy_policy'])->name('privacy_policy');

Route::get('/my-goods', [PageController::class, 'my_goods'])->name('my_goods');

Route::get('/products', [ProductController::class, 'showProducts'])->name('products');
Route::get('/recommendation-location', [ProductController::class, 'recommendation_location'])->name('recommendation_location');




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
Route::post('/my-goods/add', [GoodsController::class, 'store'])->name('add_my_goods');
Route::post('/my-goods/add-img', [GoodsController::class, 'storeImg'])->name('add_img');
Route::post('/wishlist/add', [ProductController::class, 'addToWishlist'])->name('wishlist.add');

Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send_message');




