<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Http\Controllers\Website\HeaderController;
use App\Http\Controllers\Website\FooterController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Specified key was too long; max key length is 767 bytes
        // Schema::defaultStringLength(191);
        
        $header = new HeaderController();
        $footer = new FooterController();

        view()->share('header',$header);  
        view()->share('footer',$footer);  

        // \DB::listen(function($query) {
        //     $sql = $query->sql;
        //     $bindings = $query->bindings;
        //     $executionTime = $query->time;

        //     // info($sql);
        //     // info($bindings);
        //     // info($executionTime);

        //     // do something with the above. Log it, stream it via pusher, etc
        // });
    }
}
