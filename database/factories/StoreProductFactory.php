<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\StoreProducts;
use Faker\Generator as Faker;

$factory->define(StoreProducts::class, function (Faker $faker) {
    return [
        'store_id'=>$this->faker->numberBetween(1,10),
        'product_id'=>$this->faker->numberBetween(1,10),
        'quantity'=>$this->faker->numberBetween(1,10000),
    ];
});
