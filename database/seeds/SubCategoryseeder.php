<?php

use App\Models\SubCategories;
use Illuminate\Database\Seeder;

class SubCategoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SubCategories::class,10)->create();

    }
}
