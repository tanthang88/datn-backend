<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create table products
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name', 255)->unique();
            $table->string('product_slug', 255)->unique();
            $table->string('product_image', 255)->nullable();
            $table->integer('product_price')->nullable();
            $table->integer('product_quantity')->default(0);
            $table->integer('product_views')->default(0);
            $table->boolean('product_display')->default(1);
            $table->integer('product_order')->default(1);
            $table->boolean('product_outstanding')->default(1);
            $table->text('product_content')->nullable();
            $table->text('product_desc')->nullable();
            $table->string('seo_title', 200)->nullable();
            $table->string('seo_description', 200)->nullable();
            $table->string('seo_keywords', 1000)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplier_id');
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
        Schema::dropIfExists('products');
    }
};
