<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//Setup No.1
use Illuminate\Support\Facades\Schema;
use App\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Setup No.1
        Schema::defaultStringLength(191);
        view()->composer('layouts/app', function ($view) {
            $aPosts = Post::where('post_type' ,'=', '1' )->where('post_active' ,'!=', '1' )->get()->toArray();
            $gPosts = Post::where('post_type' ,'=', '0' )->where('post_active' ,'!=', '1' )->get()->toArray();
            $allposts = array_merge($aPosts,$gPosts);

            // Sort the array using the call back function
            usort($allposts, function($a,$b) { 
                return $a['created_at'] < $b['created_at'];
            });

            

            $view->with('allposts', $allposts);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
