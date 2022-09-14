<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CategoriesPosts extends Model
{
    use HasFactory, SoftDeletes, Notifiable;    
    /**
     * table
     *
     * @var string
     */
    protected $table = 'categories_posts';    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = array(
        'category_post_name',
        'category_post_order',
        'category_post_display',
        'category_post_slug',
    );    
    /**
     * timestamps
     *
     * @var bool
     */
    public $timestamps = true;
}
