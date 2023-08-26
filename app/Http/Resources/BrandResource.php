<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'logo' => $this->getMedia('logo')->map(fn($media) =>  [
                'thumb' => $media->getUrl('thumb'),
                'small' => $media->getUrl('small'),
            ])->first(),
        ];
    }
}
