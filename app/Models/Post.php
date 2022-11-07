<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory, SoftDeletes, Notifiable;
    const POST_BLOCK = 0;
    const POST_ACTIVE = 1;

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
        'id',
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

    /**
     * getPostCategory
     *
     * @return void
     */
    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'category_id', 'id');
    }
}
