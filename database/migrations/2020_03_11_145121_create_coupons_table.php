<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('link')->nullable();
            $table->integer('amount');
            $table->integer('brand_id')->unsigned();
            $table->string('coupon_code')->nullable();
            $table->enum('type', ['suggestion','normal','unique']);
            $table->timestamp('expire_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coupons');
    }
}
