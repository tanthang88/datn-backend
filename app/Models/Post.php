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
        'post_title',
        'post_slug',
        'post_describe',
        'post_content',
        'post_status',
        'post_outstanding',
        'id',
        'category_id',
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
