<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImaxdUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imaxd_users', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('full_name')->nullable();
            $table->string('rut')->nullable();
            $table->string('dv_rut')->nullable();
            $table->integer('type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_rut')->nullable();
            $table->string('company_dv_rut')->nullable();
            $table->string('ocupation')->nullable();
            $table->string('address')->nullable();

            $table->integer('region_id')->unsigned()->nullable();
            $table->foreign('region_id')->references('id')->on('cities');

            $table->integer('commune_id')->unsigned()->nullable();
            $table->foreign('commune_id')->references('id')->on('communes');

            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('web')->nullable();
            $table->string('notification_mail')->nullable();

            $table->integer('company_size_id')->unsigned()->nullable();
            $table->foreign('company_size_id')->references('id')->on('company_sizes');

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
        Schema::dropIfExists('imaxd_users');
    }
}
