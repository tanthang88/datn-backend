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
        Schema::table('products', function (Blueprint $table) {
            $table->text('product_promotion_desc')->nullable()->after('product_desc');
            $table->boolean('is_variation')->default(0)->comment('0->Không biến thể ; 1->Có biến thể')->after('supplier_id');
            $table->boolean('is_discount_product')->default(0)->comment('0:Không giảm giá sản phẩm,1:Giảm giá sản phẩm')->after('is_variation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
        });
    }
};
