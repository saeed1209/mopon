<?php namespace Tests\Repositories;

use App\Models\UniqueCouponUser;
use App\Repositories\UniqueCouponUserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UniqueCouponUserRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UniqueCouponUserRepository
     */
    protected $uniqueCouponUserRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->uniqueCouponUserRepo = \App::make(UniqueCouponUserRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_unique_coupon_user()
    {
        $uniqueCouponUser = factory(UniqueCouponUser::class)->make()->toArray();

        $createdUniqueCouponUser = $this->uniqueCouponUserRepo->create($uniqueCouponUser);

        $createdUniqueCouponUser = $createdUniqueCouponUser->toArray();
        $this->assertArrayHasKey('id', $createdUniqueCouponUser);
        $this->assertNotNull($createdUniqueCouponUser['id'], 'Created UniqueCouponUser must have id specified');
        $this->assertNotNull(UniqueCouponUser::find($createdUniqueCouponUser['id']), 'UniqueCouponUser with given id must be in DB');
        $this->assertModelData($uniqueCouponUser, $createdUniqueCouponUser);
    }

    /**
     * @test read
     */
    public function test_read_unique_coupon_user()
    {
        $uniqueCouponUser = factory(UniqueCouponUser::class)->create();

        $dbUniqueCouponUser = $this->uniqueCouponUserRepo->find($uniqueCouponUser->id);

        $dbUniqueCouponUser = $dbUniqueCouponUser->toArray();
        $this->assertModelData($uniqueCouponUser->toArray(), $dbUniqueCouponUser);
    }

    /**
     * @test update
     */
    public function test_update_unique_coupon_user()
    {
        $uniqueCouponUser = factory(UniqueCouponUser::class)->create();
        $fakeUniqueCouponUser = factory(UniqueCouponUser::class)->make()->toArray();

        $updatedUniqueCouponUser = $this->uniqueCouponUserRepo->update($fakeUniqueCouponUser, $uniqueCouponUser->id);

        $this->assertModelData($fakeUniqueCouponUser, $updatedUniqueCouponUser->toArray());
        $dbUniqueCouponUser = $this->uniqueCouponUserRepo->find($uniqueCouponUser->id);
        $this->assertModelData($fakeUniqueCouponUser, $dbUniqueCouponUser->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_unique_coupon_user()
    {
        $uniqueCouponUser = factory(UniqueCouponUser::class)->create();

        $resp = $this->uniqueCouponUserRepo->delete($uniqueCouponUser->id);

        $this->assertTrue($resp);
        $this->assertNull(UniqueCouponUser::find($uniqueCouponUser->id), 'UniqueCouponUser should not exist in DB');
    }
}
