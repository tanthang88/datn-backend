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

    const  PAYMENT_OFFLINE = 0;
    const PAYMENT_ONLINE = 1;

    const TYPE_OFFLINE = 0;
    const TYPE_ONLINE = 1;
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
        'sale',
        'fee',
        'note',
        'bill_price',
        'payment',
        'bill_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * get attribute check type
     *
     */
    protected function getTypePaymentAttribute(): bool
    {
        return $this->type === Bill::TYPE_OFFLINE;
    }

    /**
     * get attribute check type
     *
     */
    protected function getCanCancelAttribute(): bool
    {
        return $this->bill_status === Bill::BILL_STATUS_WAITING_CONFIRM;
    }

    /**
     * get Status bill
     *
     * @return string
     */
    public function getStatusLabelAttribute(): string
    {
        $label = [
            '' => '',
            self::BILL_STATUS_WAITING_CONFIRM => 'Chờ xác nhận',
            self::BILL_STATUS_CONFIRMED => 'Đã xác nhận',
            self::BILL_STATUS_BEING_TRANSPORTED => 'Đang giao hàng',
            self::BILL_STATUS_SUCCESS => 'Giao hàng thành công',
            self::BILL_STATUS_CANCEL => 'Huỷ đơn',
        ];
        return $label[$this->bill_status];
    }

    /**
     * get Payment Label
     *
     * @return string
     */
    public function getPaymentLabelAttribute(): string
    {
        $label = [
            '' => '',
            self::PAYMENT_OFFLINE => 'Thanh toán khi nhận hàng',
            self::PAYMENT_ONLINE => 'Thanh toán trực tuyến',
        ];
        return $label[$this->payment];
    }

    /**
     * get type Payment
     *
     * @return string
     */
    public function getTypeLabelAttribute(): string
    {
        $label = [
            '' => '',
            self::TYPE_OFFLINE => 'Mua hàng tại cửa hàng',
            self::TYPE_ONLINE => 'Mua hàng trực tuyến',
        ];
        return $label[$this->type];
    }

    /**
     * get Address bill Attribute
     *
     * @return string
     */
    public function getBillAddressAttribute()
    {
        return join(', ', array_filter([$this->address, $this->dist?->name, $this->city?->name], 'strlen'));
    }


    public function billDetails()
    {
        return $this->hasMany(BillDetail::class, 'bill_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function dist()
    {
        return $this->belongsTo(Dist::class, 'dist_id', 'id');
    }
}
