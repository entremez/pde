<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instances', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers');

            $table->integer('classification_id')->unsigned();
            $table->foreign('classification_id')->references('id')->on('classifications');

            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');

            $table->integer('employees_range')->unsigned();
            $table->foreign('employees_range')->references('id')->on('employees');

            $table->integer('business_type')->unsigned();
            $table->foreign('business_type')->references('id')->on('business_types');

            $table->string('name');
            $table->string('company_name');
            $table->string('company_logo')->nullable();
            $table->string('quantity');
            $table->string('unit')->nullable();;
            $table->string('sentence');
            $table->text('long_description');
            $table->text('quote');
            $table->text('name_quote');
            $table->text('position_quote');
            $table->integer('year');
            $table->boolean('approved');
            $table->boolean('featured')->default(false);

            $table->boolean('status')->default(false); //0 sin modificación, 1 con info en buffer

            $table->softDeletes();
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
        Schema::dropIfExists('instances');
    }
}
