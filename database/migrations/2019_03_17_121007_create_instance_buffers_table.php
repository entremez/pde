<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstanceBuffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instance_buffers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('instance_id')->unsigned();
            $table->foreign('instance_id')->references('id')->on('instances');

            $table->integer('classification_id')->unsigned();
            $table->foreign('classification_id')->references('id')->on('classifications');

            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');

            $table->integer('employees_range')->unsigned();
            $table->foreign('employees_range')->references('id')->on('employees');            

            $table->integer('business_type')->unsigned();
            $table->foreign('business_type')->references('id')->on('business_types');

            $table->string('name');
            $table->string('company_name');
            $table->string('company_logo')->nullable();
            $table->integer('quantity');
            $table->string('unit')->nullable();;
            $table->string('sentence');
            $table->text('long_description');
            $table->text('quote');
            $table->integer('year');
            $table->string('image');


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
        Schema::dropIfExists('instance_buffers');
    }
}
