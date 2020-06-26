<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reseller_id');
            $table->unsignedBigInteger('category_id')->default(0);
            $table->string('title');
            $table->longText('content');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->enum('visibility', ['0', '1'])->default(0)->comment('0 = Not published, 1 = Published');
            $table->enum('type', ['0', '1', '2'])->default(0)->comment('0 = blog, 1 = trending blog, 2 = popular blog');
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
        Schema::dropIfExists('cms_blogs');
    }
}
