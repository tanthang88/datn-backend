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
        Schema::table('bills', function (Blueprint $table) {
            $table->integer('sale');
            $table->integer('fee');
            $table->text('note')->nullable();
            $table->integer('payment')->default(0)->comment('0: Thanh toán khi nhận hàng, 1:Thanh toán online');
            $table->integer('type')->default(0)->comment('0:Mua hàng offline, 1:Mua hàng online');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
