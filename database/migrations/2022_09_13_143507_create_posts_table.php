<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');

            $table->string('post_name', 500)->unique();
            $table->string('post_slug', 500)->unique();
            $table->string('type', 255);
            $table->text('post_desc')->nullable();
            $table->longText('post_content')->nullable();
            $table->boolean('post_display')->default(1);
            $table->integer('post_order')->default(1);
            $table->boolean('post_outstanding')->default(1);
            $table->string('post_seo_title', 200)->nullable();
            $table->string('post_seo_keyword', 1000)->nullable();
            $table->string('post_seo_description', 200)->nullable();
            $table->index(array('id', 'category_id', 'post_display', 'post_outstanding'));

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
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
        Schema::dropIfExists('posts');
    }
};
