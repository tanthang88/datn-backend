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
            $table->string('propertie_name',255);
            $table->string('propertie_img',255);
            $table->integer('propertie_price');
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
        //
    }
};
