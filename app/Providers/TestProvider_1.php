<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TestProvider_1 extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("Homer", function() {
            return "Our Home";
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
