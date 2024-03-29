<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propertie extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'properties';
    protected $fillable = [
        'propertie_name',
        'propertie_slug',
        'propertie_value',
        'product_id',
        'created_at',
        'updated_at',
    ];
    public function product(){
        return $this->belongTo(Product::class, 'product_id', 'id');
    }
    public function variantion()
    {
        return $this->hasMany(Variantion::class, 'propertie_id', 'id');
    }
}
