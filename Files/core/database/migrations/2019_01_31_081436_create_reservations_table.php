<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->unique();
            $table->timestamp('date');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('room_type_id');
            $table->integer('adults')->default(1);
            $table->integer('kids')->default(0);
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('number_of_room')->default(1);
            $table->enum('status',['PENDING','CANCEL','SUCCESS'])->default('PENDING');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('reservations');
    }
}
