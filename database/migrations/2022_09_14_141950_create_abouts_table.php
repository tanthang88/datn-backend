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
        Schema::create('abouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('about_name',255)->unique();
            $table->string('about_slug',255)->unique();
            $table->string('type',255);
            $table->integer('about_order')->default(1);
            $table->boolean('about_display')->default(1);
            $table->string('about_desc',500)->nullable();
            $table->text('about_content')->nullable();
            $table->string('seo_title',200)->nullable();
            $table->string('seo_keyword',1000)->nullable();
            $table->string('seo_description',200)->nullable();
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
        Schema::dropIfExists('abouts');
    }
};
