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
        Schema::create('product_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comment_name', 255);

            $table->string('comment_phone', 255);
            $table->string('comment_email', 255)->nullable();
            $table->string('comment_content', 500);
            $table->boolean('comment_display')->default(0);
            $table->integer('comment_rating')->nullable();
            $table->integer('parent_id')->default(0);
            $table->unsignedBigInteger('customer_id')->nullable();
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
        Schema::dropIfExists('product_comments');
    }
};
