<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_comments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins');

            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers');

            $table->integer('instance_id')->unsigned()->nullable();
            $table->foreign('instance_id')->references('id')->on('instances');

            $table->integer('type');
            $table->text('message');

            $table->integer('status')->default(1);

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
        Schema::dropIfExists('provider_comments');
    }
}
