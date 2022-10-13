<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutDetailResource extends JsonResource
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
            'about_title' => $this->about_name,
            'about_desc' => $this->about_desc,
            'type' =>$this->type,
            'about_content' => $this->about_content,
            'about_slug' => $this->about_slug,
            'seo_title' => $this->seo_title,
            'seo_keyword' => $this->seo_keyword,
            'seo_description' => $this->seo_description,
            'date' => $this->created_at,

        ];
    }
}
