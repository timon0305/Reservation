<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaidServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->enum('price_type',['PER_PERSON','PER_NIGHT','FIXED_PRICE']);
            $table->float('price',8,2)->default(0);
            $table->longText('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
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
        Schema::dropIfExists('paid_services');
    }
}
