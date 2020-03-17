<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTypeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_type_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->unsignedInteger('room_type_id');
            $table->boolean('featured')->default(0);
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
        Schema::dropIfExists('room_type_images');
    }
}
