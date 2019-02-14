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
            $table->string('name')->default('NA');
            $table->string('email')->default('NA');
            $table->string('phone_number', 12)->nullable();
            $table->integer('otp')->nullable();
            $table->string('password')->nullable();
            $table->string('verifyToken')->nullable();
            $table->string('device_token')->nullable();
            $table->string('onesignal_token')->nullable();
            $table->integer('status')->default(0);
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
