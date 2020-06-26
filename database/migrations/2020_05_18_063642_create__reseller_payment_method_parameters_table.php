<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResellerPaymentMethodParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseller_payment_methods_parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id');
            $table->unsignedBigInteger('global_payment_methods_id');
            $table->string('form_label')->nullable();
            $table->string('key')->nullable();
            $table->string('value')->nullable();
            $table->enum('status', ['0', '1'])->default('0')->comment('0 = Disabled, 1 = Enabled');
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
        Schema::dropIfExists('reseller_payment_methods_parameters');
    }
}
