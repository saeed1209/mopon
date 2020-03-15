<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'description' => $faker->text,
        'category_id' => factory(Category::class)->create()->id,
        'website' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
