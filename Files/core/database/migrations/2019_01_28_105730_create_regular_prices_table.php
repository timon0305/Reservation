<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegularPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regular_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('room_type_id');
            $table->enum('day_1',['ADD','LESS']);
            $table->float('day_1_amount',8,2)->default(0);
            $table->enum('day_2',['ADD','LESS']);
            $table->float('day_2_amount',8,2)->default(0);
            $table->enum('day_3',['ADD','LESS']);
            $table->float('day_3_amount',8,2)->default(0);
            $table->enum('day_4',['ADD','LESS']);
            $table->float('day_4_amount',8,2)->default(0);
            $table->enum('day_5',['ADD','LESS']);
            $table->float('day_5_amount',8,2)->default(0);
            $table->enum('day_6',['ADD','LESS']);
            $table->float('day_6_amount',8,2)->default(0);
            $table->enum('day_7',['ADD','LESS']);
            $table->float('day_7_amount',8,2)->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('regular_prices');
    }
}
