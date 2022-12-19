<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $request = $request;
        return [
            'bill_address' => $this->bill_address,
            'bill_customer_name' => $this->customer_name,
            'bill_customer_phone' => $this->bill_phone,
            'bill_price' => $this->bill_price,
            'bill_status_label' => $this->status_label,
            'payment' => $this->payment_label,
            'type' => $this->type_payment,
            'type_pay' => $this->type_label,
            'bill_details' => $this->billDetails,
            'fee' => $this->fee,
            'sale' => $this->sale,
            'sale' => $this->note,
            'created_at' => $this->created_at,
            'can_cancel' => $this->can_cancel
        ];
    }
}
