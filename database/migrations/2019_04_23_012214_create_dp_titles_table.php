<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDpTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dp_titles', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('stage_id')->unsigned();
            $table->foreign('stage_id')->references('id')->on('dp_stages');

            $table->text('name');
            $table->text('background');
            $table->text('border');
            $table->text('logo');

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
        Schema::dropIfExists('dp_titles');
    }
}
