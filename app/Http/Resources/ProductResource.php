<?php

namespace App\Http\Resources;

use App\Models\ProductCategories;
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
            'product_configurations' => $this->productConfig,
            'is_variation' => $this->is_variation,
            'is_selling' => $this->is_selling,
            'product_outstanding' => $this->product_outstanding,
            'is_discount_product' => $this->is_discount_product,
            'properties' => $this->productPropertie,
            'category_name' => $this->productCategory?->category_name,
            'category_parent_id' => $this->productCategory?->parent_id,
        ];
    }
}
