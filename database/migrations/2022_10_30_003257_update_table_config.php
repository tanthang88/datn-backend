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
        Schema::table('configurations', function (Blueprint $table) {
            $table->decimal('config_screen',3,1)->default(0)->change();
            $table->decimal('config_camera',3,1)->default(0)->change();
            $table->decimal('config_selfie',3,1)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->float('config_screen')->nullable();
            $table->float('config_camera')->nullable();
            $table->float('config_selfie')->nullable();
        });
    }
};
