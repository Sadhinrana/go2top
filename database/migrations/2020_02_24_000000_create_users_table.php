<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('username')->unique()->nullable();
            $table->string('skype_name')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->decimal('balance', 10, 2)->default(0);
            $table->string('api_key')->unique()->nullable();
            $table->string('referral_key')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending');
            $table->unsignedBigInteger('referrer_id')->nullable();
            $table->unsignedBigInteger('reseller_id');
            $table->foreign('reseller_id')->on('resellers')->references('id')->onDelete('cascade');
            $table->timestamp('last_login_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
