<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        // 在 footer 视图中绑定 location 数据
        view()->composer('layouts.app', function($view) use ($request) {
            $location = geoip($request->ip());
            $view->with('location', $location->country.' - '.$location->state_name.' - '.$location->city);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
