<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponPivotIncludeRoomTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_pivot_include_room_type', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('coupon_id');
            $table->unsignedInteger('room_type_id');
            $table->timestamps();
            $table->foreign('coupon_id')->references('id')->on('coupon_masters')->onDelete('cascade');
            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_pivot_include_room_type');
    }
}
