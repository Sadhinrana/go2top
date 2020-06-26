<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStatusToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            \DB::statement('ALTER TABLE `users` CHANGE `status` `status` ENUM(\'pending\',\'active\',\'inactive\') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT \'pending\';');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            \DB::statement('ALTER TABLE `users` CHANGE `status` `status` ENUM(\'active\',\'inactive\') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT \'inactive\';');
        });
    }
}
