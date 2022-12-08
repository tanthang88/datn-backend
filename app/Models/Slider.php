<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';
    public $timestamps = false;
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
