<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImaxdEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imaxd_evaluations', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('imaxd_user_id')->unsigned()->nullable();
            $table->foreign('imaxd_user_id')->references('id')->on('imaxd_users');

            $table->integer('status')->unsigned()->default(0);

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
        Schema::dropIfExists('imaxd_evaluations');
    }
}
