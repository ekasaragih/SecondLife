<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserDataMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $user = Auth::user();
            View::share('currentUser', $user);
        }

        return $next($request);
    }
}

