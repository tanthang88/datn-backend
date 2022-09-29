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
        Schema::create('companies', function (Blueprint $table) {
            $table->string('company_name',255)->unique();
            $table->string('company_slug',255)->unique();
            $table->string('company_email',255);
            $table->string('company_phone',10);
            $table->string('company_address',255);
            $table->string('company_fanpage',255)->nullable();
            $table->string('company_favicon',255)->nullable();
            $table->string('company_copyright',255)->nullable();
            $table->string('company_work_time',255);
            $table->string('company_work_day',255);
            $table->text('company_ggmap');
            $table->text('company_gg_analytic')->nullable();
            $table->text('company_webmaster')->nullable();
            $table->string('company_hotline',20);
            $table->string('seo_title',200)->nullable();
            $table->string('seo_keyword',1000)->nullable();
            $table->string('seo_description',200)->nullable();
            $table->timestamps();
            $table->charset = 'utf8mb4';
    $table->collation = 'utf8mb4_unicode_ci';
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
        Schema::dropIfExists('companies');
    }
};
