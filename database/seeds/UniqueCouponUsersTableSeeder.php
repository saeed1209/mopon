<?php

use Illuminate\Database\Seeder;

class UniqueCouponUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\UniqueCouponUser::class, 5)->create();
    }
}
