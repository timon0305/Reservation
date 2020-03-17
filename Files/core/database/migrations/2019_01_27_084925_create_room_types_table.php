<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('short_code')->unique();
            $table->longText('description')->nullable();
            $table->integer('base_capacity')->default(0);
            $table->integer('higher_capacity')->default(0);
            $table->boolean('extra_bed')->default(0);
            $table->integer('kids_capacity')->default(0);
            $table->float('base_price',8,2)->default(0);
            $table->float('additional_person_price',8,2)->default(0);
            $table->float('extra_bed_price',8,2)->default(0);
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
        Schema::dropIfExists('room_types');
    }
}
