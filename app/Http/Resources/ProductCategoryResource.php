<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
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
            'id' => $this->id,
            'category_name' => $this->category_name,
            'category_slug' => $this->category_slug,
            'category_image'=>$this->category_image,
            'parent_id' => $this->parent_id,
            'children'=>$this->children
        ];
    }
}
