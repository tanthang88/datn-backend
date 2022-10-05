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
        Schema::create('post_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name', 255)->unique();
            $table->string('category_slug', 255)->unique();
            $table->integer('category_order')->default(1);
            $table->boolean('category_display')->default(1);
            $table->boolean('category_outstanding')->default(1);
            $table->text('category_desc')->nullable();
            $table->string('type',255);
            $table->text('category_content')->nullable();
            $table->string('category_title',100)->nullable();
            $table->string('seo_keyword',1000)->nullable();
            $table->string('seo_description',200)->nullable();
            $table->index('id');
            $table->timestamps();
            $table->softDeletes();
            $table->charset = 'utf8mb4';
    $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_categories');
    }
};
