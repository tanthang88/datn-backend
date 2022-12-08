<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'product_categories';
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'category_name',
        'category_slug ',
        'category_image',
        'category_display',
        'category_order',
        'category_outstanding',
        'category_content',
        'category_desc',
        'parent_id',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];
}
