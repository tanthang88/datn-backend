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
        Schema::create('admin_promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('promotion_code', 255)->unique();
            $table->string('promotion_name', 255)->unique();
            $table->integer('promotion_photo', 255);
            $table->integer('promotion_order',11);
            $table->boolean('promotion_display');
            $table->boolean('promotion_outstanding');
            $table->text('promotion_desc');
            $table->integer('promotion_numer_of_use',11);
            $table->boolean('promotion_status');
            $table->unsignedBigInteger('promotion_id_product');
            $table->unsignedBigInteger('promotion_id_product_combo');
            $table->integer('promotion_rate',11);
            $table->integer('promotion_type',11);
            // $table->unsignedBigInteger('promotion_id_customer');
            $table->integer('promotion_money_discount ',11);
            $table->text('promotion_content');
            $table->dateTime('promotion_datestart');
            $table->dateTime('promotion_dateend');
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
        Schema::dropIfExists('admin_promotions');
    }
};
