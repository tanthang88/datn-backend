<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class About extends Model
{
    use HasFactory;
    const ABOUT_BLOCK = 0;
    const ABOUT_ACTIVE = 1;
    protected $table = 'abouts';
    protected $fillable = [
        'about_name',
        'about_slug',
        'type',
        'about_order',
        'about_display',
        'about_desc',
        'about_content',
        'seo_title',
        'seo_keyword',
        'seo_description'
    ];
    function city(){
        return $this->belongsTo(City::class, 'id_city', 'code');
    }
}
