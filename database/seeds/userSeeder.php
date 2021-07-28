<?php

use Illuminate\Database\Seeder;
use App\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = factory(User::class,100)->create();
        $obj1 = $c[0];
        // dd($obj1);
    }
}





//
