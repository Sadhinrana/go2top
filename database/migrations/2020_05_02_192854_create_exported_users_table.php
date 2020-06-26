<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exported_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('from');
            $table->date('to');
            $table->string('status');
            $table->string('format');
            $table->string('include_columns');
            $table->unsignedBigInteger('reseller_id');
            $table->foreign('reseller_id')->on('resellers')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('exported_users');
    }
}
