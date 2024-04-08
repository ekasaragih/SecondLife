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
Route::get('/explore', [PageController::class, 'explore'])->name('explore');




/*
|--------------------------------------------------------------------------
| Post & Get Functions
|--------------------------------------------------------------------------
*/