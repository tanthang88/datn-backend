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
            $table->id();
            $table->unsignedBigInteger('categories_post_id');
            $table->string('post_title', 500);
            $table->string('post_slug', 500);
            $table->longText('post_describe');
            $table->longText('post_content');
            $table->boolean('post_status');
            $table->boolean('post_outstanding');
            $table->string('post_seo_title', 200)->nullable();
            $table->string('post_seo_keyword', 1000)->nullable();
            $table->string('post_seo_description', 200)->nullable();
            $table->index(array('id', 'categories_post_id', 'post_status', 'post_outstanding'));
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
