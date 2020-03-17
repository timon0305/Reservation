<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reservation_id');
            $table->unsignedInteger('tax_id');
            $table->enum('type',['PERCENTAGE','FIXED']);
            $table->float('value',8,2)->default(0);
            $table->float('price',8,2)->default(0);
            $table->timestamps();
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->foreign('tax_id')->references('id')->on('tax_managers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_taxes');
    }
}
