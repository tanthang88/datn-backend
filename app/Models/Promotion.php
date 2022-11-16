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
        'promotion_name',
        'promotion_numer_of_use',
        'promotion_numer_of_used',
        'promotion_status',
        'promotion_rate',
        'promotion_type',
        'promotion_money_discount ',
        'promotion_datestart',
        'promotion_dateend',
        'type'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'promotion_id_customer', 'id');
    }
    public function promotionProduct()
    {
        return $this->hasMany(PromotionProduct::class, 'promotion_id', 'id');
    }
}
