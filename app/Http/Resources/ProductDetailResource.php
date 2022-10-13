<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
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
            'product_category_name' => $this->productCategory?->category_name,
            'product_suppiler_name' => $this->supplier?->supplier_name,
            'product_title' => $this->product_name,
            'product_desc' => $this->product_desc,
            'product_content' => $this->product_content,
            'product_slug' => $this->product_slug,
            'product_image' => $this->product_image,
            'product_quantity' => $this->product_quantity,
            'product_seo_title' => $this->seo_title,
            'product_seo_desc' => $this->seo_desc,
            'product_seo_keyword' => $this->seo_keyword,
            'product_seo_description' => $this->seo_description,
        ];
    }
}
