<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommended_services', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('option_id')->unsigned();
            $table->foreign('option_id')->references('id')->on('options');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');

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
        Schema::dropIfExists('recommended_services');
    }
}
