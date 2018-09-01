<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut');
            $table->string('dv_rut');
            $table->string('name');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('web')->nullable();
            $table->string('logo')->nullable();
            $table->string('description')->nullable();
            $table->text('long_description')->nullable();
            $table->boolean('approved')->default(false);
            $table->integer('status')->default(0);

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('providers');
    }
}
