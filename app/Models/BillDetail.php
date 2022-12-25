<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    /**
     * table
     *
     * @var string
     */
    protected $table = 'bill_details';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'bill_id',
        'product_id',
        'product_image',
        'product_name',
        'price',
        'amount',
        'into_price',
        'variant_id',
        'variant_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }
}
