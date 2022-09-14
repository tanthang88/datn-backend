<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'product_image',
        'product_price',
        'quantity',
        'viewCounts',
        'status',
        'product_content',
        'description',
        'seo_titles',
        'seo_keywords',
        'seo_descriptions',
        'category_id',
        'supplier_id',
        'product_order',
        'product_outstanding',
        'created_at'
    ];
}
