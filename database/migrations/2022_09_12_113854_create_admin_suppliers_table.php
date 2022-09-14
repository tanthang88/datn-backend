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
        Schema::create('admin_suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_name', 255)->unique();
            $table->string('supplier_slug', 255)->unique();
            $table->integer('supplier_photo', 255);
            $table->integer('supplier_order', 11);
            $table->boolean('supplier_display');
            $table->boolean('supplier_outstanding');
            $table->text('category_desc');
            $table->string('supplier_address',255);
            $table->text('supplier_map');
            $table->string('supplier_phone',10);
            $table->string('supplier_email',200);
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
        Schema::dropIfExists('admin_suppliers');
    }
};
