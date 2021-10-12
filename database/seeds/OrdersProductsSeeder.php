<?php

use App\OrderProducts;
use Illuminate\Database\Seeder;

class OrdersProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrderProducts::class,10)->create();

    }
}
