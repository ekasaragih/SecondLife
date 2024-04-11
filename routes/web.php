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
Route::get('/communities', [PageController::class, 'communities'])->name('communities');
Route::get('/profile', [PageController::class, 'user_profile'])->name('user_profile');




/*
|--------------------------------------------------------------------------
| Post & Get Functions
|--------------------------------------------------------------------------
*/