<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollectionResource extends JsonResource
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
            'sale_price' => (float) $this->sale_price,
            'regular_price' => (float) $this->regular_price,
            'discount_amount' => $this->discountAmount(),
            'discount_rate' => $this->discountRate(),
            'thumbnail_url' => $this->thumbnailUrl(),
        ];
    }
}
