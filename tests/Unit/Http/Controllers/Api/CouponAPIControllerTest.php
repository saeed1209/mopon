<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Models\Brand;
use App\Models\Coupon;
use Faker\Generator as Faker;
use Tests\TestCase;

class CouponAPIControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_list_of_coupons()
    {
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_token()
        ])->get('/api/coupons');

        $response->assertStatus(200);
    }

    public function test_get_single_coupon()
    {
        $coupon = factory(Coupon::class)->create();
        $response = $this->withHeaders([
                'Authorization' => '‌Bearer '.self::get_token()
            ])->get('/api/coupons/'.$coupon->id);

        $response->assertStatus(200);
    }

    public function test_user_has_not_access_to_save_coupon_resource()
    {
        $coupon = factory(Coupon::class)->create();
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_token()
        ])->post('/api/coupons/');

        $response->assertStatus(403);
    }

    public function test_a_coupon_can_be_saved_successfully()
    {
        $faker = app(Faker::class);
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->post('/api/coupons/',[
            'title' => $faker->word,
            'link' => $faker->word,
            'amount' => $faker->randomDigitNotNull,
            'brand_id' => factory(Brand::class)->create()->id,
            'coupon_code' => $faker->word,
            'type' => $faker->randomElement(['suggestion','normal', 'unique']),
        ]);

        $response->assertStatus(200);
    }

    public function test_saving_a_coupon_with_invalid_brand_id()
    {
        $faker = app(Faker::class);
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->post('/api/coupons/',[
            'title' => $faker->word,
            'link' => $faker->word,
            'amount' => $faker->randomDigitNotNull,
            'brand_id' => 0,
            'coupon_code' => $faker->word,
            'type' => $faker->randomElement(['suggestion','normal', 'unique']),
        ]);

        $response->assertStatus(404);
    }

    public function test_saving_a_coupon_title_validation()
    {
        $faker = app(Faker::class);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->post('/api/coupons/',[
            'title' => null,
            'link' => $faker->word,
            'amount' => $faker->randomDigitNotNull,
            'brand_id' => 0,
            'coupon_code' => $faker->word,
            'type' => $faker->randomElement(['suggestion','normal', 'unique']),
        ]);

        $response->assertStatus(422);
    }

    public function test_saving_a_coupon_amount_validation()
    {
        $faker = app(Faker::class);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->post('/api/coupons/',[
            'title' => $faker->word,
            'link' => $faker->word,
            'amount' => null,
            'brand_id' => 0,
            'coupon_code' => $faker->word,
            'type' => $faker->randomElement(['suggestion','normal', 'unique']),
        ]);

        $response->assertStatus(422);
    }

    public function test_saving_a_coupon_type_validation()
    {
        $faker = app(Faker::class);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->post('/api/coupons/',[
            'title' => $faker->word,
            'link' => $faker->word,
            'amount' => $faker->randomDigitNotNull,
            'brand_id' => factory(Brand::class)->create()->id,
            'coupon_code' => $faker->word,
            'type' => null,
        ]);

        $response->assertStatus(422);
    }

    public function test_update_coupon()
    {
        $faker = app(Faker::class);
        $coupon = factory(Coupon::class)->create();
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->put('/api/coupons/'.$coupon->id,[
            'title' => $faker->word,
            'link' => $faker->word,
            'amount' => $faker->randomDigitNotNull,
            'brand_id' => factory(Brand::class)->create()->id,
            'coupon_code' => $faker->word,
            'type' => $faker->randomElement(['suggestion','normal', 'unique']),
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_coupon()
    {
        $coupon = factory(Coupon::class)->create();
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->delete('/api/coupons/'.$coupon->id);

        $response->assertStatus(200);
    }
}
