<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderBuffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_buffers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('provider_id')->unsigned()->nullable();
            $table->foreign('provider_id')->references('id')->on('providers');

            $table->string('rut')->nullable();
            $table->string('dv_rut')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('web')->nullable();
            $table->string('logo')->nullable();
            $table->string('description')->nullable();
            $table->text('long_description')->nullable();


            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities');

            $table->integer('commune_id')->unsigned()->nullable();
            $table->foreign('commune_id')->references('id')->on('communes');

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
        Schema::dropIfExists('provider_buffers');
    }
}
