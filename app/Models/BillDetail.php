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
        'sale',
        'fee',
        'total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
