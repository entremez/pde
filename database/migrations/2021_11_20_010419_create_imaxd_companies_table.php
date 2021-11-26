<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImaxdCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imaxd_companies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('imaxd_evaluation_id')->unsigned()->nullable();
            $table->foreign('imaxd_evaluation_id')->references('id')->on('imaxd_evaluations');

            $table->boolean('startup_statement')->nullable();
            $table->boolean('sanitary_resolution')->nullable();

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
        Schema::dropIfExists('imaxd_companies');
    }
}
