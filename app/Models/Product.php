<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
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
        'product_quantity',
        'product_display',
        'product_content',
        'seo_titles',
        'seo_keywords',
        'seo_descriptions',
        'category_id',
        'supplier_id',
        'product_order',
        'product_outstanding',
        'created_at'
    ];

    public function product_categories()
    {
        return $this->hasOne(ProductCategories::class, 'id', 'category_id');
    }
    public function configurations()
    {
        return $this->hasOne(Configurations::class, 'product_id', 'id');
    }
    public function product_images()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id');
    }

}
