<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('offer_title');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->dateTime('period_start_time');
            $table->dateTime('period_end_time');
            $table->string('code')->unique();
            $table->enum('type',['PERCENTAGE','FIXED'])->default('PERCENTAGE');
            $table->float('value',8,2)->default(0);
            $table->float('min_amount',8,2)->default(0);
            $table->float('max_amount',8,2)->default(0);
            $table->integer('limit_per_user')->default(0);
            $table->integer('limit_per_coupon')->default(0);
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_masters');
    }
}
