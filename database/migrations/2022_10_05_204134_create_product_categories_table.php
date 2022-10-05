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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('category_name', 255)->unique();
             $table->string('category_slug', 255)->unique();
             $table->string('category_image', 255)->nullable();
             $table->boolean('category_display')->default(1);
             $table->integer('category_order')->default(1);
             $table->boolean('category_outstanding')->default(1);
             $table->text('category_content')->nullable();
             $table->text('category_desc')->nullable();
             $table->bigInteger('parent_id')->default(0)->comment('0: Là danh mục chính');
             $table->string('seo_title', 200)->nullable();
             $table->string('seo_description', 200)->nullable();
             $table->string('seo_keywords', 1000)->nullable();
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
        Schema::dropIfExists('product_categories');
    }
};
