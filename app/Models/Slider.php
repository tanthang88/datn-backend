<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Slider extends Model
{
    use HasFactory;
    const PROMOTION = 0;
    const PRODUCT = 1;
    const ACCESSORY = 2;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'sliders';

    public $timestamps = false;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'image',
        'link',
        'type',
        'desc',
        'content',
        'display',
        'order',
    ];
}
