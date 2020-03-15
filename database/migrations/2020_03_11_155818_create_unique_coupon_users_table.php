<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUniqueCouponUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unique_coupon_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coupon_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('coupon_code');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('unique_coupon_users');
    }
}
