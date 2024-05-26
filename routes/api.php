<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\WishlistController;
use App\Http\Controllers\API\ExchangeController;

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
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('remove_wishlist');

    // CHAT
    Route::post('/chat/send', [ChatController::class, 'send'])->name('send_message');
    Route::get('/chat/messages', [ChatController::class, 'fetch'])->name('fetch_message');

    // EXCHANGE
    Route::post('/exchange/store', [ExchangeController::class, 'store'])->name('exchange.store');
    Route::post('/exchange/confirm/{id}', [ExchangeController::class, 'confirmExchange'])->name('exchange.confirm');
    Route::post('/exchange/reject/{id}', [ExchangeController::class, 'rejectExchange'])->name('exchange.reject');
    Route::post('/exchange/{exchange}/updateStatus', [ExchangeController::class, 'updateStatus'])->name('exchange.updateStatus');


});