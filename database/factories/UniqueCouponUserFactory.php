<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Coupon;
use App\Models\UniqueCouponUser;
use App\User;
use Faker\Generator as Faker;

$factory->define(UniqueCouponUser::class, function (Faker $faker) {

    return [
        'coupon_id' => factory(Coupon::class)->create([
            'type' => 'unique'
        ])->id,
        'user_id' => factory(User::class)->create([
            'role' => 'user'
        ])->id,
        'coupon_code' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
