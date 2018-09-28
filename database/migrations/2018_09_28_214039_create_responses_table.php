<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('survey_response_id')->unsigned();
            $table->foreign('survey_response_id')->references('id')->on('survey_responses');

            $table->integer('response_choice_id')->unsigned();
            $table->foreign('response_choice_id')->references('id')->on('response_choices');

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
        Schema::dropIfExists('responses');
    }
}
