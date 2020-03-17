<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('gateway_id');
            $table->float('amount',8,2)->default(0);
            $table->float('usd_amo',8,2)->default(0);
            $table->string('trx');
            $table->boolean('status')->default(0);
            $table->boolean('try')->default(0);
            $table->float('btc_amo',8,2)->default(0);
            $table->float('btc_wallet',8,2)->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('payments');
    }
}
