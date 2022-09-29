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
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->string('bill_phone',10);
            $table->string('customer_name',255);
            $table->string('address',250);
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('dist_id');
            

            $table->integer('bill_price');
            $table->integer('bill_status')->default(0)->comment("0:Chờ xác nhận,1:Đã xác nhận,2:Đang giao hàng,3:Giao hàng thành công,4:Huỷ");
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
        Schema::dropIfExists('bills');
    }
};
