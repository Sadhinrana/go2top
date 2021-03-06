<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('transaction_type', ['withdraw', 'deposit']);
            $table->double('amount', 10, 2)->nullable();
            $table->enum('transaction_flag', ['payment_gateway', 'refund', 'admin_panel', 'order_place', 'other']);
            $table->integer('user_id')->unsigned();
            $table->integer('admin_id')->unsigned()->nullable();
            $table->enum('status', ['hold', 'done']);
            $table->string('memo', 250)->nullable();
            $table->string('fraud_risk', 250)->nullable();
            $table->longText('payment_gateway_response')->nullable();
            $table->longText('transaction_detail')->nullable();
            $table->longText('reseller_payment_methods_setting_id')->nullable();
            $table->longText('reseller_id')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
