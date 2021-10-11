<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name(),
        'address'=>$this->faker->address,
        // 'quantity'=>$this->faker->numerify('###'),
        'vendor_id'=>$this->faker->numberBetween(1,10),

    ];
});
