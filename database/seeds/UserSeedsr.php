<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeedsr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,10)->create();

    }
}
