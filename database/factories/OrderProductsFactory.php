<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderProducts;
use Faker\Generator as Faker;

$factory->define(OrderProducts::class, function (Faker $faker) {
    return [
        'order_id'=>$this->faker->numberBetween(2,10),
        'product_id'=>$this->faker->numberBetween(16,30),
        'quantity'=>$this->faker->numberBetween(1,10000),
    ];
});
