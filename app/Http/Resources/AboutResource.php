<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
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
            'about_slug' => $this->about_slug,
            'about_desc' => $this->about_desc,
            'type'=>$this->type,
            'date' => $this->created_at,
        ];
    }
}
