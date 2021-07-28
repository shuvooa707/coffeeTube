<?php

namespace App\Providers;


use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use App\Paka;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register ()
    {
        $this->app->bind('IoC', function() {
            return "Giving IoC";
        });
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot ()
    {
        View::share('user', Auth::user() );
    }
}
