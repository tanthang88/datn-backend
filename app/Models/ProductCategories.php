<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
class ProductCategories extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_categories';
    protected $fillable = [
        'id',
        'category_name',
        'category_slug',
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
        'created_at',
        'updated_at',
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function children()
    {
        return $this->hasMany(ProductCategories::class, 'parent_id');
    }
}
