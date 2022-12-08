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
        Schema::create('configurations', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->float('config_screen')->nullable();
            $table->string('config_cpu', 255)->nullable();
            $table->integer('config_ram')->nullable();
            $table->float('config_camera')->nullable();
            $table->float('config_selfie')->nullable();
            $table->integer('config_battery')->nullable();
            $table->string('config_system',255)->nullable();

            $table->charset = 'utf8mb4';
    $table->collation = 'utf8mb4_unicode_ci';

            $table->index('id');
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
        Schema::dropIfExists('configurations');
    }
};
