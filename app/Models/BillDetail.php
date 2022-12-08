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
        'price',
        'amount',
        'into_price',
        'total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
