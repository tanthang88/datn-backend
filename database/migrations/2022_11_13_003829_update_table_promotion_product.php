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
           $table->string('promotion_code',255)->nullable()->change();
           $table->unsignedBigInteger('promotion_id_product')->nullable()->change();
           $table->unsignedBigInteger('promotion_id_product_combo')->nullable()->change();
           $table->integer('promotion_order_value')->nullable()->change();//giá trị đơn hàng
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
            $table->string('promotion_code',255)->unique();
            $table->unsignedBigInteger('promotion_id_product');
            $table->unsignedBigInteger('promotion_id_product_combo');
            $table->integer('promotion_order_value');//giá trị đơn hàng
        });
    }
};
