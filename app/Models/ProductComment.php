<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ProductComment extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'product_comments';
    public $timestamps = true;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'comment_name',
        'comment_phone',
        'comment_email',
        'comment_content',
        'customer_id',
        'comment_display',
        'parent_id',
    ];

    /**
     * childrenComment
     *
     * @return HasMany
     */
    public function childrenComment(): HasMany
    {
        return $this->hasMany(ProductComment::class, 'parent_id', 'id');
    }

    /**
     * customer
     *
     * @return belongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    /**
     * customer
     *
     * @return belongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
