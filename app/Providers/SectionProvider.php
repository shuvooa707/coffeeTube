<?php

namespace App\Providers;
use App\sections\SectionManager;

use App\section;

use Illuminate\Support\ServiceProvider;

class SectionProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("fruit", function () {
            return ["banana", "apple", "pineapple", "mango", "guava"][random_int(0,3)];
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
