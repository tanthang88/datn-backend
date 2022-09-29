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
        Schema::create('order_trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bill_id');
            $table->integer('status')->default(0)->comment('0:Đã lấy hàng,1:Đang vận chuyển,2:Thành công,3:Thất bại');
            $table->unsignedInteger('city_id');
            
            $table->dateTime('date_now')->comment('Ngày hiện tại của kiện hàng');
            $table->dateTime('date_expected')->comment('Ngày dự kiến giao hàng');
            $table->timestamps();
            $table->charset = 'utf8mb4';
    $table->collation = 'utf8mb4_unicode_ci';
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
        Schema::dropIfExists('order_trackings');
    }
};
