<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImages extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_images';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'images',
        'product_id',
        'created_at'
    ];
}
