<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->date('dob');
            $table->longText('address')->nullable();
            $table->enum('sex',['M','F','O'])->default('M');
            $table->string('picture')->nullable();
            $table->string('password');
            $table->string('id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->string('id_card_image')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('vip')->default(0);
            $table->boolean('email_verified')->default(0);
            $table->boolean('email_verified_code')->default(0);
            $table->boolean('sms_verified')->default(0);
            $table->boolean('sms_verified_code')->default(0);
            $table->boolean('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
