<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTags extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_tags';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'tags',
        'product_id',
        'created_at'
    ];
}
