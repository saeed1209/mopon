<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\User;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_login_with_email_and_password()
    {
        $user = factory(User::class)->create([
            'email' => 'test@mail.com',
            'password' => bcrypt('123456')
        ]);

        $response = $this->postJson('/api/login',[
            'email' => $user->email,
            'password' => '123456'
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_logout()
    {
        $response = $this->withHeaders([
            'Authorization' => '‌Bearer '.self::get_token()
        ])->get('/api/logout');

        $response->assertStatus(200);
    }
}
