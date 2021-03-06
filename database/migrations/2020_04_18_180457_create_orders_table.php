<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->enum('status', ['awaiting', 'processing', 'inprogress', 'completed', 'pending', 'partial', 'cancelled', 'failed', 'error'])->default('pending');
            $table->decimal('charges',15,5)->nullable();
            $table->decimal('original_charges',15,5)->default(0);
            $table->decimal('unit_price',15,5)->default(0);
            $table->decimal('original_unit_price',15,5)->default(0);
            $table->string('link');
            $table->integer('start_counter')->nullable();
            $table->integer('remains')->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->string('provider_order_id', 200)->nullable();
            $table->foreign('service_id')->on('services')->references('id')->onDelete('cascade');
            $table->text('custom_comments')->nullable();
            $table->string('mode',100)->nullable();
            $table->enum('source', ['WEB', 'API'])->default('WEB');
            $table->integer('drip_feed_id')->nullable();
            $table->dateTime('order_viewable_time')->nullable();
            $table->longText('text_area_1')->nullable();
            $table->longText('text_area_2')->nullable();
            $table->longText('additional_inputs')->nullable();
            $table->string('refill_status', false)->default(false);
            $table->enum('refill_order_status', ['success', 'processing', 'pending', 'rejected', 'cancelled', 'error'])->nullable();
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
        Schema::dropIfExists('orders');
    }
}
