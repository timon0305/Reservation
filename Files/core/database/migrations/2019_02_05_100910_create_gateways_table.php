<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->integer('id')->primary()->index();
            $table->string('main_name')->unique();
            $table->string('name')->nullable();
            $table->float('minamo',8,2)->default(0);
            $table->float('maxamo',8,2)->default(0);
            $table->float('fixed_charge',8,2)->default(0);
            $table->float('percent_charge',8,2)->default(0);
            $table->float('rate',8,2)->default(0);
            $table->string('val1')->nullable();
            $table->string('val2')->nullable();
            $table->string('val3')->nullable();
            $table->string('val4')->nullable();
            $table->string('val5')->nullable();
            $table->string('val6')->nullable();
            $table->string('val7')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('gateways');
    }
}
