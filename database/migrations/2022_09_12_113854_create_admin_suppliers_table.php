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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_name', 255)->unique();
            $table->string('supplier_photo', 255)->nullable();
            $table->integer('supplier_order')->default(1);
            $table->boolean('supplier_display')->default(1);
            $table->boolean('supplier_outstanding')->default(1);
            $table->text('category_desc')->nullable();
            $table->string('supplier_address',255);
            $table->text('supplier_map')->nullable();
            $table->string('supplier_phone',10);
            $table->string('supplier_email',200);
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
        Schema::dropIfExists('suppliers');
    }
};
