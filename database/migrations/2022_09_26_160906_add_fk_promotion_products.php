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
        Schema::table('promotion_products', function (Blueprint $table) {
            //
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('promotion_id_product')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('promotion_id_product_combo')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promotion_products', function (Blueprint $table) {
            //
        });
    }
};
