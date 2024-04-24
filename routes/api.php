<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\WishlistController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/profile/show', [ProfileController::class, 'show']);

Route::group(['middleware' => 'auth'], function () {
    // PROFILE
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('update.avatar');

    // WISHLIST
    Route::post('/wishlist/store', [WishlistController::class, 'store'])->name('add_wishlist');

    // CHAT
    Route::post('/chat/send', [ChatController::class, 'send'])->name('send_message');
});