<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminSupplier extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'suppliers';
    protected $fillable = [
        'supplier_name',
        'supplier_slug',
        'supplier_photo',
        'supplier_order',
        'supplier_display',
        'supplier_outstanding',
        'category_desc',
        'supplier_address',
        'supplier_map',
        'supplier_phone',
        'supplier_email',
        'created_at',
        'updated_at',
    ];
}