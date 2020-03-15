<?php

namespace Tests\Unit\Http\Controllers\API;

use App\Models\Brand;
use App\Models\Coupon;
use App\Models\UniqueCouponUser;
use App\User;
use Tests\TestCase;
use Faker\Generator as Faker;

class UniqueCouponUserAPITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_list_of_unique_coupon_users()
    {
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->get('/api/unique_coupon_users');

        $response->assertStatus(200);
    }

    public function test_user_has_not_access_to_save_unique_coupon_user_resource()
    {
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_token()
        ])->get('/api/unique_coupon_users');

        $response->assertStatus(403);
    }

    public function test_get_single_unique_coupon_user()
    {
        $unique_coupon_user = factory(UniqueCouponUser::class)->create();
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->get('/api/unique_coupon_users/'.$unique_coupon_user->id);

        $response->assertStatus(200);
    }

    public function test_saving_a_unique_coupon_user_with_invalid_coupon_id()
    {
        $faker = app(Faker::class);
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->post('/api/unique_coupon_users/',[
            'coupon_id' => 0,
            'user_id' => factory(User::class)->create([
                'role' => 'user'
            ])->id,
            'coupon_code' => $faker->word
        ]);

        $response->assertStatus(404);
    }

    public function test_saving_a_unique_coupon_user_with_invalid_coupon_type()
    {
        $coupon = factory(Coupon::class)->create([
            'type' => 'normal'
        ]);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->post('/api/unique_coupon_users/',[
            'coupon_id' => $coupon->id,
            'user_id' => factory(User::class)->create([
                'role' => 'user'
            ])->id
        ]);

        $response->assertStatus(400);
    }

    public function test_saving_a_unique_coupon_user_coupon_id_validation()
    {
        $faker = app(Faker::class);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->post('/api/unique_coupon_users/',[
            'coupon_id' => null,
            'user_id' => factory(User::class)->create([
                'role' => 'user'
            ])->id,
            'coupon_code' => $faker->word
        ]);

        $response->assertStatus(422);
    }

    public function test_saving_a_unique_coupon_user_user_id_validation()
    {
        $faker = app(Faker::class);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->post('/api/unique_coupon_users/',[
            'coupon_id' => factory(Coupon::class)->create([
                'type' => 'unique'
            ])->id,
            'user_id' => null,
            'coupon_code' => $faker->word
        ]);

        $response->assertStatus(422);
    }

    public function test_delete_coupon()
    {
        $unique_coupon_user = factory(UniqueCouponUser::class)->create();
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_admin_token()
        ])->delete('/api/unique_coupon_users/'.$unique_coupon_user->id);

        $response->assertStatus(200);
    }
}
