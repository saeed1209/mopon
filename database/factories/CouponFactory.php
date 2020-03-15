<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use App\Models\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'link' => $faker->word,
        'amount' => $faker->randomDigitNotNull,
        'brand_id' => factory(Brand::class)->create()->id,
        'coupon_code' => $faker->word,
        'type' => $faker->randomElement(['suggestion','normal','unique']),
        'expire_at' => null,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
