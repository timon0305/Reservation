<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->unsignedInteger('category_id')->nullable()->default(NULL);
            $table->enum('type',['image','url','video']);
            $table->string('link')->nullable();
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
        Schema::dropIfExists('web_galleries');
    }
}
