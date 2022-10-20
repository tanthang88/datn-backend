<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    const BILL_STATUS_WAITING_CONFIRM = 0;
    const BILL_STATUS_CONFIRMED = 1;
    const BILL_STATUS_BEING_TRANSPORTED = 2;
    const BILL_STATUS_SUCCESS = 3;
    const BILL_STATUS_CANCEL = 4;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'bills';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'customer_id',
        'bill_phone',
        'customer_name',
        'address',
        'city_id',
        'dist_id',
        'bill_price',
        'bill_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     *
     * The attributes that are mass assignable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billDetails()
    {
        return $this->hasMany(BillDetail::class, 'bill_id', 'id');
    }

    /**
     *
     * The attributes that are mass assignable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

}
