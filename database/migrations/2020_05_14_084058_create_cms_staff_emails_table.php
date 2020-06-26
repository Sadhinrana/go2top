<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsStaffEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_staff_emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id');
            $table->string('email');
            $table->enum('payment_received', ['0', '1'])->default('0')->comment('0 = Inactive, 1 = Active');
            $table->enum('new_manual_orders', ['0', '1'])->default('0')->comment('0 = Inactive, 1 = Active');
            $table->enum('fail_orders', ['0', '1'])->default('0')->comment('0 = Inactive, 1 = Active');
            $table->enum('new_messages', ['0', '1'])->default('0')->comment('0 = Inactive, 1 = Active');
            $table->enum('new_manual_payout', ['0', '1'])->default('0')->comment('0 = Inactive, 1 = Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_staff_emails');
    }
}
