<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drop_point_id')->unsigned()->index();
            $table->string('day')->nullable();
            $table->string('start_time')->default('00:00');
            $table->string('end_time')->default('00:00');
            $table->string('lunch_start_time')->default('00:00');
            $table->string('lunch_end_time')->default('00:00');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('timings');
    }
}
