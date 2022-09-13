<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Posts extends Model
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
        'post_title',
        'post_slug',
        'post_describe',
        'post_content',
        'post_status',
        'post_outstanding',
    ];    
    /**
     * timestamps
     *
     * @var bool
     */
    public $timestamps = true;
}
