<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Authorization
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages/explore');
});

Route::get('/login', [AuthorizationController::class, 'login'])->name('login');
Route::get('/register', [AuthorizationController::class, 'register'])->name('register');

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/
Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/electronic', [PageController::class, 'electronic'])->name('electronic');



Route::get('/communities', [PageController::class, 'communities'])->name('communities');
Route::get('/profile', [PageController::class, 'user_profile'])->name('user_profile');


Route::get('/contact-us', [PageController::class, 'contact_us'])->name('contact_us');
Route::get('/privacy-policy', [PageController::class, 'privacy_policy'])->name('privacy_policy');





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