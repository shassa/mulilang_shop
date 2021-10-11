<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Vendors;
use Faker\Generator as Faker;

$factory->define(Vendors::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name(),
        'email' => $this->faker->unique()->safeEmail(),
        'password' => bcrypt(123456789), // password
        'logo'=>'http://lorempixel.com/400/200/people/',
        'category_id'=>$this->faker->numberBetween(1,10),
        'address'=>$this->faker->address,
        'mobile'=>$this->faker->numerify('##########'),
        'active'=>1
    ];
});
