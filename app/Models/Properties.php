<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'properties';
    protected $fillable = [
        'company_ propertie_name',
        'company_propertie_img',
        'company_propertie_price',
        'company_product_id',
        'company_created_at',
        'company_updated_at',
   
    ];
}
