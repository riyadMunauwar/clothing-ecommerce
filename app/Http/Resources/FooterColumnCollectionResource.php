<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FooterColumnAttributeCollectionResource;

class FooterColumnCollectionResource extends JsonResource
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
            'column_title' => $this->column_title,
            'items' =>  FooterColumnAttributeCollectionResource::collection($this->attributes->where('is_published', true)),
        ];
    }
}
