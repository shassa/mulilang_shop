<?php

use App\Models\MainCategories;
use Illuminate\Database\Seeder;

class MaincategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MainCategories::class,10)->create();

    }
}
