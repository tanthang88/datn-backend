<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes, Notifiable;
    /**
     * table
     *
     * @var string
     */
    protected $table = 'post_categories';
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = array(
        'category_name',
        'category_order',
        'category_display',
        'category_slug',
        'id',
    );
    /**
     * timestamps
     *
     * @var bool
     */
    public $timestamps = true;

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
