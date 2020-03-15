<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UniqueCouponUser;

class UniqueCouponUserApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_unique_coupon_user()
    {
        $uniqueCouponUser = factory(UniqueCouponUser::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/unique_coupon_users', $uniqueCouponUser
        );

        $this->assertApiResponse($uniqueCouponUser);
    }

    /**
     * @test
     */
    public function test_read_unique_coupon_user()
    {
        $uniqueCouponUser = factory(UniqueCouponUser::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/unique_coupon_users/'.$uniqueCouponUser->id
        );

        $this->assertApiResponse($uniqueCouponUser->toArray());
    }

    /**
     * @test
     */
    public function test_update_unique_coupon_user()
    {
        $uniqueCouponUser = factory(UniqueCouponUser::class)->create();
        $editedUniqueCouponUser = factory(UniqueCouponUser::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/unique_coupon_users/'.$uniqueCouponUser->id,
            $editedUniqueCouponUser
        );

        $this->assertApiResponse($editedUniqueCouponUser);
    }

    /**
     * @test
     */
    public function test_delete_unique_coupon_user()
    {
        $uniqueCouponUser = factory(UniqueCouponUser::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/unique_coupon_users/'.$uniqueCouponUser->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/unique_coupon_users/'.$uniqueCouponUser->id
        );

        $this->response->assertStatus(404);
    }
}
