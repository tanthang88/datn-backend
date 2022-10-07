<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'post_title' => $this->post_name,
            'post_slug' => $this->post_slug,
            'post_desc' => $this->post_desc,
            'date' => $this->created_at,
            'category_name' => $this->postCategory?->category_name,
        ];
    }
}
