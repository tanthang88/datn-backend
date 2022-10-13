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
            'name' => $this->category_name,
            'slug' => $this->category_slug,
            'parent_id' => $this->parent_id,
        ];
    }
}
