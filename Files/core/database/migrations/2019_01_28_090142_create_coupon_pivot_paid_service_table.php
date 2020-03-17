<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponPivotPaidServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_pivot_paid_service', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('coupon_id');
            $table->unsignedInteger('paid_service_id');
            $table->timestamps();
            $table->foreign('coupon_id')->references('id')->on('coupon_masters')->onDelete('cascade');
            $table->foreign('paid_service_id')->references('id')->on('paid_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_pivot_paid_service');
    }
}
