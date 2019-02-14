<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDropPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('drop_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->string('address');
            $table->string('driver_message')->nullable();
            $table->string('city')->nullable();
            $table->string('image')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->integer('pincode')->nullable();
            $table->boolean('show_in_app')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->boolean('rampe')->default(0);
            $table->boolean('crane')->default(0);
            $table->boolean('rampe_small')->default(0);
            $table->boolean('rampe_medium')->default(0);
            $table->boolean('rampe_big')->default(0);
            $table->string('m_hight')->nullable();
            $table->boolean('special_requirement')->default(0);
            $table->string('craner_type')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('drop_points');
    }
}
