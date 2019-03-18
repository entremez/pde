<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderServiceBuffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_service_buffers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers');

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
        Schema::dropIfExists('provider_service_buffers');
    }
}
