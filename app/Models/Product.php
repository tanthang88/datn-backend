<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Supplier;

class Product extends Model
{
    use HasFactory, SoftDeletes,Notifiable;
    protected $table = 'products';
    const PRODUCT_BLOCK = 0;
    const PRODUCT_ACTIVE = 1;
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
        'rating',
        'created_at'
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategories::class, 'category_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productConfig()
    {
        return $this->hasOne(Configuration::class, 'product_id', 'id');
    }

    public function productPropertie()
    {
        return $this->hasMany(Propertie::class, 'product_id', 'id');
    }

    public function productVariantion()
    {
        return $this->hasMany(Variantion::class, 'product_id', 'id');
    }

    public function productComments()
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }
    public function promotionProduct()
    {
        return $this->hasMany(PromotionProduct::class, 'promotion_id_product', 'id');
    }
    public function promotionProductCombo()
    {
        return $this->hasMany(PromotionProduct::class, 'promotion_id_product_combo', 'id');
    }
}
