<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('service_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->integer('provider_service_id')->unsigned();
            $table->string('name', 100)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('category', 100)->nullable();
            $table->decimal('rate', 10,2)->nullable();
            $table->decimal('min', 10,2)->nullable();
            $table->decimal('max', 10,2)->nullable();
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
        Schema::dropIfExists('provider_services');
    }
}
