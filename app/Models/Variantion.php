<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Variantion extends Model
{
    use HasFactory, SoftDeletes,Notifiable;
    protected $table = 'variantions';
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'propertie_id',
        'product_id',
        'product_id_link',
        'price',
        'img',
    ];
    public function propertie()
    {
        return $this->belongsTo(Propertie::class, 'propertie_id', 'id');
    }
    public function product()
    {
        return $this->belongTo(Product::class, 'product_id', 'id');
    }
}

