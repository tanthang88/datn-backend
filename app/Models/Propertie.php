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
        'propertie_value',
        'product_id',
        'created_at',
        'updated_at',
    ];
}
