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
        Schema::create('categories_posts', function (Blueprint $table) {
            $table->id();
            $table->string('category_post_name', 255);
            $table->integer('category_post_order');
            $table->boolean('category_post_display');
            $table->string('category_post_slug', 255);
            $table->index('id');
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
        Schema::dropIfExists('categories_posts');
    }
};
