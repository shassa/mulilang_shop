<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Orders;
use Faker\Generator as Faker;

$factory->define(Orders::class, function (Faker $faker) {
    return [
        'hashcode'=>$faker->asciify('********************'),
        'total'=>$this->faker->numerify('#####'),
        'payment_method'=>0,
        'user_id'=>$this->faker->numberBetween(1,10),
    ];
});
