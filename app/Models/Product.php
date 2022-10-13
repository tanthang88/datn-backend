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
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
