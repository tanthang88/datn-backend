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
            $table->string('product_name');
            $table->string('product_image');
            $table->integer('product_price');
            $table->integer('quantity');
            $table->integer('viewCounts');
            $table->boolean('status');
            $table->text('product_content');
            $table->string('description');
            $table->string('seo_titles');
            $table->string('seo_keywords');
            $table->bigIncrements('category_id');
            $table->bigIncrements('supplier');
            $table->integer('product_order');
            $table->integer('product_outstanding');
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
