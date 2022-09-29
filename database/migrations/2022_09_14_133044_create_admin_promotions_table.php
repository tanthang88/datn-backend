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
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('promotion_name', 255)->unique();
            $table->string('promotion_photo', 255)->nullable();
            $table->integer('promotion_order')->default(1);
            $table->boolean('promotion_display')->default(1);
            $table->boolean('promotion_outstanding')->default(1);
            $table->text('promotion_desc')->nullable();
            $table->integer('promotion_numer_of_use')->default(0);//số lượt sử dụng
            $table->integer('promotion_numer_of_used')->default(0);//số lượt đã sử dụng
            $table->boolean('promotion_status')->default(0)->comment('0: Chưa diễn ra , 1: Đang diễn ra , 2:Đã kết thúc');
            $table->integer('promotion_type')->default(0)->comment('0:Giảm giá theo %, 1:Giảm giá theo số tiền');
            $table->text('promotion_id_customer')->nullable();// 29|30|31
            $table->text('promotion_content')->nullable();
            $table->dateTime('promotion_datestart');
            $table->dateTime('promotion_dateend');
            $table->index(array('id', 'promotion_display', 'promotion_outstanding'));
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
        Schema::dropIfExists('promotions');
    }
};
