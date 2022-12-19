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
        Schema::table('bill_details', function (Blueprint $table) {
             $table->dropForeign(['product_id']);
             $table->string('product_image')->after('price');
             $table->string('product_name')->after('price');
             $table->string('variant_name')->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('product_image');
        $table->dropColumn('product_name');
        $table->dropColumn('variant_name');
    }
};
