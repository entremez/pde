<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDpBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dp_bodies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('title_id')->unsigned();
            $table->foreign('title_id')->references('id')->on('dp_titles');            
            $table->integer('sentence_id')->unsigned();
            $table->foreign('sentence_id')->references('id')->on('dp_sentences');

            $table->text('body');
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
        Schema::dropIfExists('dp_bodies');
    }
}
