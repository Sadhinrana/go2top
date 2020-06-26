<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsSettingModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_setting_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id');
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('commission_rate', 10, 2)->default(0);
            $table->enum('approve_payout', ['0', '1'])->default(0)->comment('0 = Manual, 1 = Auto');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['1', '2', '3'])->comment('1 = Affiliate system, 2 = Child panels selling, 3 = Free balance');
            $table->enum('status', ['0', '1'])->default(1)->comment('0 = Inactive, 1 = active');
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
        Schema::dropIfExists('cms_setting_modules');
    }
}
