<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'promotions';
    protected $fillable = [
        'promotion_code',
        'promotion_name',
        'promotion_photo',
        'promotion_order',
        'promotion_display',
        'promotion_outstanding',
        'promotion_desc',
        'promotion_numer_of_use',
        'promotion_used',
        'promotion_status',
        'promotion_id_product',
        'promotion_id_product_combo',
        'promotion_rate',
        'promotion_type',
        'promotion_id_customer',
        'promotion_money_discount ',
        'promotion_content',
        'promotion_datestart',
        'promotion_dateend',
        'created_at',
        'updated_at',
    ];
}
