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
        Schema::create('variantions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('propertie_id');
            $table->unsignedBigInteger('product_id');
            $table->text('propertie_id_link');
            $table->integer('price');
            $table->string('img',255);
            $table->foreign('propertie_id')->references('id')->on('properties')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('variantions');
    }
};
