<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name(),
        'photo'=>'http://lorempixel.com/400/200/sports/',
        'brand_id'=>$this->faker->numberBetween(1,10),
        'translation_lang'=>'ar',
        'translation_of'=>0,
        'price'=>$this->faker->numerify('###'),
        'sq_code'=>$this->faker->numerify('#####'),
    ];
});
