<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brands;
use Faker\Generator as Faker;

$factory->define(Brands::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name(),
        'photo'=>'http://lorempixel.com/400/200/sports/',
        'vendor_id'=>$this->faker->numberBetween(1,10),
        'subcategory_id'=>$this->faker->numberBetween(1,10),
        'translation_lang'=>'ar',
        'translation_of'=>0

    ];
});
