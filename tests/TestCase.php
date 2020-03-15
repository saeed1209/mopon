<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed( \DatabaseSeeder::class);
    }

    protected function get_token()
    {
        $user = factory(User::class)->create([
            'role' => 'user'
        ]);

        return JWTAuth::fromUser($user);
    }

    protected function get_admin_token()
    {
        $user = factory(User::class)->create([
            'role' => 'admin'
        ]);

        return JWTAuth::fromUser($user);
    }
}
