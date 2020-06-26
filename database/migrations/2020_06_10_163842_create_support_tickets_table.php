<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('subject', ['order', 'payment', 'service', 'other'])->default('Other');
            $table->string('subject_ids', 200)->nullable()->comment('comma separated ids');
            $table->string('payment_type', 100)->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->integer('user_id')->unsigned();
            $table->integer('send_by')->unsigned();
            $table->string('sender_role', 100)->nullable();
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
        Schema::dropIfExists('support_tickets');
    }
}
