<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Properties extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'properties';
    protected $fillable = [
        'property_name',
        'property_img',
        'property_price',
        'product_id',
        'created_at',
        'updated_at',
   
    ];
}
