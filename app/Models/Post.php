<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory,SoftDeletes, Notifiable;
    /**
     * table
     *
     * @var string
     */
    protected $table = 'posts';
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'post_name',
        'post_slug',
        'type',
        'post_desc',
        'post_content',
        'post_display',
        'post_order',
        'post_outstanding',
        'post_seo_title',
        'post_seo_keyword',
        'post_sep_description',
        'created_at',
        'update_at',
    ];
    /**
     * timestamps
     *
     * @var bool
     */
    public $timestamps = true;
}
