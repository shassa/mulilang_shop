<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MainCategories;
use Faker\Generator as Faker;

$factory->define(MainCategories::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name(),
        'slug' => $this->faker->name(),
        'photo'=>'http://lorempixel.com/200/400/technics/',
        'translation_lang'=>'ar',
        'translation_of'=>0
    ];
});
