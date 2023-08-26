<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_tags' => $this->meta_tags,
            'meta_description' => $this->meta_description,
            'icon_url' => [
                'thumb' => $this->iconUrl('thumb'),
                'small' => $this->iconUrl('small'),
            ],
            'children' => static::collection($this->children->where('is_published', true)),
        ];
    }
}
