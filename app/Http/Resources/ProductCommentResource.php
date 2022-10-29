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
            'customer_id' => $this->customer_id,
            'comment_name' => $this->comment_name,
            'comment_content' => $this->comment_content,
            'comment_date' => convertDateTimetoStr($this->created_at),
            'children_comments' => $this->collection($this->childrenComment),
        ];
    }
}
