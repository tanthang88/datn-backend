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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->unique();
            $table->string('image',255)->nullable();
            $table->string('link',255)->nullable();
            $table->string('type',255);
            $table->string('desc',500)->nullable();
            $table->text('content')->nullable();
            $table->boolean('display')->default(1);
            $table->integer('order')->default(1);
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
        Schema::dropIfExists('sliders');
    }
};
