<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VariantionResource extends JsonResource
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
            'price' => $this->price,
            'sale'=> $this->sale,
            'rate'=> $this->rate,
            'type'=> $this->type,
            'img' => $this->img,
            'note'=>'Nhớ gửi id biến thể này khi mua hàng'
        ];
    }
}
