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
        Schema::create('promotion_products', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->unsignedBigInteger('promotion_id');
            $table->string('promotion_code', 255)->unique();
            $table->unsignedBigInteger('promotion_id_product');
            $table->unsignedBigInteger('promotion_id_product_combo');
            $table->integer('promotion_rate');//mức giảm
            $table->integer('promotion_order_value');//giá trị đơn hàng
            $table->index('id');
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
        Schema::dropIfExists('promotion_products');
    }
};
