<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut');
            $table->string('dv_rut');
            $table->string('name');
            $table->string('address');
            $table->string('phone')->nullable();


            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('classification_id')->unsigned()->nullable();
            $table->foreign('classification_id')->references('id')->on('classifications');

            $table->integer('employees_id')->unsigned()->nullable();
            $table->foreign('employees_id')->references('id')->on('employees');

            $table->integer('gain_id')->unsigned()->nullable();
            $table->foreign('gain_id')->references('id')->on('gains');

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
        Schema::dropIfExists('companies');
    }
}
