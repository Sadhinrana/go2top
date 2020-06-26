<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResellerPaymentMethodsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseller_payment_methods_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id');
            $table->integer('global_payment_method_id');
            $table->string('method_name');
            $table->decimal('minimum')->nullable();
            $table->decimal('maximum')->nullable();
            $table->enum('new_user_status', ['0', '1'])->default('1')->comment('0 = Inactive, 1 = Active');
            $table->enum('visibility', ['0', '1'])->default('0')->comment('0 = Disabled, 1 = Enabled');
            $table->integer('sort')->default(0);
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
        Schema::dropIfExists('reseller_payment_methods_settings');
    }
}
