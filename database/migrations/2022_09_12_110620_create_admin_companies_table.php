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
        Schema::create('admin_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name',255)->unique();
            $table->string('company_slug',255)->unique();
            $table->string('company_email',255)->unique();
            $table->string('company_phone',10);
            $table->string('company_address',255);
            $table->string('company_fanpage',255);
            $table->string('company_favicon',255);
            $table->string('company_copyright',255);
            $table->string('company_work_time',255);
            $table->string('company_work_day',255);
            $table->text('company_ggmap');
            $table->text('company_gg_analytic');
            $table->text('company_webmaster');
            $table->string('company_hotline',20);
            $table->string('seo_title',200);
            $table->string('seo_keyword',1000);
            $table->string('seo_description',200);
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
        Schema::dropIfExists('admin_companies');
    }
};
