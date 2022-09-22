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
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('property_name',255);
            $table->string('property_img',255);
            $table->integer('property_price');
            $table->bigIncrements('product_id');
            $table->timestamps('created_at');
            $table->timestamps('updated_at');
            $table->softDeletes();
           
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');

    }
};
