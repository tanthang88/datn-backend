<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'product_title' => $this->product_name,
            'product_slug' => $this->product_slug,
            'product_desc' => $this->product_desc,
            'product_price' => $this->product_price,
            'product_image' => $this->product_image,
            'category_name' => $this->productCategory?->category_name,
            'product_suppiler_name' => $this->supplier?->supplier_name,
        ];
    }
}
