<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command("mns", function(){
    $this->comment("Migrating....");
    exec("php artisan migrate:fresh",$r);
    array_map(function($r){
        echo $r . "\n";
    },$r);
    $this->comment("Seeding....");
    exec("php artisan db:seed", $r);
    array_map(function ($r) {
        echo $r . "\n";
    }, $r);
});


//
