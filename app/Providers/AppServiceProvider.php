<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Wishlist;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('utils.layouts.navbar.topnav', function ($view) {
            $authenticatedUser = session('authenticatedUser');
            $wishlistCount = null;

            if ($authenticatedUser && $authenticatedUser->us_ID) {
                $wishlistCount = Wishlist::where('us_ID', $authenticatedUser->us_ID)->count();
            }

            $view->with('wishlistCount', $wishlistCount);
        });

    }   
}
