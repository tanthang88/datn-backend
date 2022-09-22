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
        'id',
        'name',
        'ship',
        'product_id',
        'created_at',
        'updated_at',
    ];
}
