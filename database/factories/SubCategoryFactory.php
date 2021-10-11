<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubCategories;
use Faker\Generator as Faker;

$factory->define(SubCategories::class, function (Faker $faker) {
    return [
        'category_id'=>$this->faker->numberBetween(1,10),
        'translation_lang'=>'ar',
        'translation_of'=>0,
        'name' => $this->faker->name(),
        'slug' => $this->faker->name(),
        'photo'=>'http://lorempixel.com/200/400/technics/',
        'active'=>1

    ];
});
