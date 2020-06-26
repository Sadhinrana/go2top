<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('mode', ['manual', 'auto']);
            $table->enum('drip_feed_status', ['allow', 'disallow'])->nullable();
            $table->enum('refill_status', ['allow', 'disallow'])->nullable();
            $table->enum('link_duplicates', ['allow', 'disallow'])->nullable();
            $table->enum('service_type',
                [
                    'Default',
                    'SEO',
                    'SEO2',
                    'Custom Comments',
                    'Custom Comments Package',
                    'Comment Likes',
                    'Mentions',
                    'Mentions with Hashtags',
                    'Mentions Custom List',
                    'Mentions Hashtag',
                    'Mentions Users Followers',
                    'Mentions Media Likers',
                    'Package',
                    'Poll',
                    'Comment Replies',
                    'Invites From Groups',
                ])->nullable();
            $table->tinyInteger('crown')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('increment')->nullable();
            $table->integer('auto_overflow')->nullable();
            $table->unsignedInteger('min_quantity')->nullable();
            $table->unsignedInteger('max_quantity')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('provider_service_id')->nullable();
            $table->boolean('provider_sync_status')->default(false);
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_user')->default(0);
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->on('categories')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('reseller_id');
            $table->foreign('reseller_id')->on('resellers')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('services');
    }
}
