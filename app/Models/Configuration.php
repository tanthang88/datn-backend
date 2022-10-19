<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Configuration extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'configurations';
    protected $fillable = [
        'config_screen',
        'config_cpu',
        'config_ram',
        'config_camera',
        'config_selfie',
        'config_battery',
        'config_system',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
