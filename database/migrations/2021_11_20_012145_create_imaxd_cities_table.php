<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImaxdCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imaxd_cities', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('imaxd_evaluation_id')->unsigned()->nullable();
            $table->foreign('imaxd_evaluation_id')->references('id')->on('imaxd_evaluations');

            $table->integer('region_id')->unsigned()->nullable();
            $table->foreign('region_id')->references('id')->on('cities');

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
        Schema::dropIfExists('imaxd_cities');
    }
}
