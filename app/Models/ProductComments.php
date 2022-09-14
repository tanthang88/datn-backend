<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ProductComments extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'product_comments';
    public $timestamps = true;
}
