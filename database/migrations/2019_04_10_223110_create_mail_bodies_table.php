<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_bodies', function (Blueprint $table) {
            $table->increments('id');

            $table->text('new_provider')->nulleable();
            $table->text('provider_approved')->nulleable();
            $table->text('new_instance')->nulleable();
            $table->text('instance_approved')->nulleable();
            $table->text('new_company')->nulleable();
            
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
        Schema::dropIfExists('mail_bodies');
    }
}
