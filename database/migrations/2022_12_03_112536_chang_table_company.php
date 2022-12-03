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
        Schema::table('companies', function (Blueprint $table) {
            $table->text('company_ggmap')->nullable()->change();
            $table->dropUnique(['company_name']);
             $table->dropUnique(['company_slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->text('company_ggmap');
            $table->unique(['company_name']);
            $table->unique(['company_slug']);

        });
    }
};
