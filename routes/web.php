<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommunitiesController;
use App\Models\Communities;

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
Route::get('/forgotPassword', [AuthorizationController::class, 'forgotPassword'])->name('forgotPassword');

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [PageController::class, 'my_profile'])->name('my_profile');
    Route::get('/wishlist', [PageController::class, 'wishlist'])->name('wishlist');
    Route::get('/my-goods', [PageController::class, 'my_goods'])->name('my_goods');
    Route::get('/goods-detail/{id}', [PageController::class, 'goods_detail'])->name('goods_detail');
    Route::get('/chat', [ChatController::class, 'index'])->name('home_chat');
});

Route::get('/', [PageController::class, 'explore'])->name('explore');
Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/communities', [PageController::class, 'communities'])->name('communities');

Route::get('/about-us', [PageController::class, 'about_us'])->name('about_us');
Route::get('/contact-us', [PageController::class, 'contact_us'])->name('contact_us');
Route::get('/privacy-policy', [PageController::class, 'privacy_policy'])->name('privacy_policy');

Route::get('/comments', [CommentController::class, 'index']);
Route::get('/comments/{g_ID}', [CommentController::class, 'getByProductId']);
Route::post('/comments', [CommentController::class, 'storeComment'])->name('comment_store');


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
Route::middleware(['auth'])->group(function () {
    // My Goods
    Route::post('/my-goods/add', [GoodsController::class, 'store'])->name('add_my_goods');
    Route::post('/my-goods/add-img', [GoodsController::class, 'storeImg'])->name('add_img');
    Route::get('/my-goods/{id}', [GoodsController::class, 'show'])->name('show_edit_my_good');
    Route::post('/my-goods/edit', [GoodsController::class, 'update'])->name('edit_my_goods');
    Route::delete('/my-goods/delete/{id}', [GoodsController::class, 'destroy'])->name('delete_my_goods');

    // Communities
    Route::post('/communities/add', [CommunitiesController::class, 'store'])->name('add_my_community_post');
    Route::post('/communities/addFeedback', [CommunitiesController::class, 'storeFeedback'])->name('add_my_community_feedback');
    Route::post('/communities/like', [CommunitiesController::class, 'like'])->name('like_community');
    Route::post('/communities/unlike', [CommunitiesController::class, 'unlike'])->name('unlike_community');
});




