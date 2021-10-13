<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductsWishlist;
use Faker\Generator as Faker;

$factory->define(ProductsWishlist::class, function (Faker $faker) {
    return [
        'wishlist_id'=>$this->faker->numberBetween(1,10),
        'products_id'=>$this->faker->numberBetween(16,30),
    ];
});
