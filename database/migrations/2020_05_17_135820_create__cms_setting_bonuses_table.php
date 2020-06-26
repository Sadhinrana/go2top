<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsSettingBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_setting_bonuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id');
            $table->integer('global_payment_method_id')->default(0);
            $table->decimal('bonus_amount', 10, 2)->default(0);
            $table->decimal('deposit_from', 10, 2)->default(0);
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
        Schema::dropIfExists('cms_setting_bonuses');
    }
}
