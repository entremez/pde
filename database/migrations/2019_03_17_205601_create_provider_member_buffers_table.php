<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderMemberBuffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_member_buffers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers');

            $table->integer('tecnics');
            $table->integer('professionals');
            $table->integer('masters');
            $table->integer('doctors');
           
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
        Schema::dropIfExists('provider_member_buffers');
    }
}
