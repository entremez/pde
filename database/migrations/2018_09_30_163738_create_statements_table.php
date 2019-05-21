<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statements', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('statement_type_id')->unsigned();
            $table->foreign('statement_type_id')->references('id')->on('statement_types');

            $table->integer('survey_id')->unsigned();
            $table->foreign('survey_id')->references('id')->on('surveys');

            $table->string('statement');
            $table->text('background');

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
        Schema::dropIfExists('statements');
    }
}
