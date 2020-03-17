<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->enum('type',['PERCENTAGE','FIXED'])->default('PERCENTAGE');
            $table->float('rate')->default(0);
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
        Schema::dropIfExists('tax_managers');
    }
}
