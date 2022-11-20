<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromotionProduct extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'promotion_products';
    protected $fillable = [
        'promotion_id',
        'promotion_code',
        'promotion_rate',
        'promotion_order_value'
    ];
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'promotion_id_product', 'id');
    }
    public function productCombo()
    {
        return $this->belongsTo(Product::class, 'promotion_id_product_combo', 'id');
    }
}
