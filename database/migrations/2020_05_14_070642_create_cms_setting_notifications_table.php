<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsSettingNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_setting_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id');
            $table->string('subject');
            $table->longText('body');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['1', '2'])->comment('1 = Users notifications, 2 = Staff notifications');
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
        Schema::dropIfExists('cms_setting_notifications');
    }
}
