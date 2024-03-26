<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;

/*
|--------------------------------------------------------------------------
| Authorization
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthorizationController::class, 'login'])->name('login');
Route::get('/register', [AuthorizationController::class, 'register'])->name('register');

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/





/*
|--------------------------------------------------------------------------
| Post & Get Functions
|--------------------------------------------------------------------------
*/