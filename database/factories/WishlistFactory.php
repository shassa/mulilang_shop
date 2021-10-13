<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Wishlist;
use Faker\Generator as Faker;

$factory->define(Wishlist::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name(),
        'user_id'=>$this->faker->numberBetween(1,10),
    ];
});
