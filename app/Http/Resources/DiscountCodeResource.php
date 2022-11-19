<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->promotion_name,
            'rate' => $this->promotionProduct->promotion_rate,
            'type'=>$this->promotion_type==0?'Giảm %':'Giảm tiền',
            'minimum_order' =>$this->promotionProduct->promotion_order_value,
            'expiry_date' => $this->promotion_dateend,
        ];
    }
}
