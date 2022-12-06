<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
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
            'post_category_name' => $this->postCategory?->category_name,
            'post_title' => $this->post_name,
            'post_img' => $this->post_img,
            'post_desc' => $this->post_desc,
            'post_content' => $this->post_content,
            'post_slug' => $this->post_slug,
            'post_seo_title' => $this->post_seo_title,
            'post_seo_desc' => $this->post_seo_desc,
            'post_seo_keyword' => $this->post_seo_keyword,
            'post_seo_description' => $this->post_seo_description,
            'date' => $this->created_at,
        ];
    }
}
