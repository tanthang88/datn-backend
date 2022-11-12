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
        Schema::table('admin_users', function (Blueprint $table) {
            $table->date('birthday')->after('password')->nullable();
            $table->tinyInteger('gender')->after('password')->nullable()->comment("0: Male, 1: Female");
            $table->string('tel')->after('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('tel');
        });
    }
};
