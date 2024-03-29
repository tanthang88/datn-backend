<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'company_fanpage',
        'company_favicon',
        'company_copyright',
        'company_work_time',
        'company_work_day',
        'company_ggmap',
        'company_gg_analytic',
        'company_webmaster',
        'company_hotline',
        'seo_title',
        'seo_keyword',
        'seo_description'
    ];
}
