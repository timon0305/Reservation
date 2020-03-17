<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppliedCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applied_coupon_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reservation_id');
            $table->unsignedInteger('coupon_id');
            $table->unsignedInteger('user_id');
            $table->date('date');
            $table->boolean('status')->default(1);
            $table->enum('coupon_type',['PERCENTAGE','FIXED'])->nullable();
            $table->float('coupon_rate',8,2)->default(0);
            $table->timestamps();
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('coupon_masters')->onDelete('cascade');
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
        Schema::dropIfExists('applied_coupon_codes');
    }
}
