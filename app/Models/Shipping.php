<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'shipping';
    protected $fillable = [
        'company_ id_',
        'company_ name_',
        'company_ship_',
        'company_product_id',
        'company_created_at',
        'company_updated_at',
    ];
}
