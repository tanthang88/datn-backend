<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCommentResource extends JsonResource
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
            'comment_id' => $this->id,
            'avatar' => $this->customer?->avatar ?? '/storage/default-avatar.png',
            'customer_id' => $this->customer_id,
            'comment_name' => $this->customer?->name ?? $this->comment_name,
            'comment_content' => $this->comment_content,
            'comment_date' => $this->created_at,
            'children_comments' => $this->collection($this->childrenComment),
        ];
    }
}
