<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VariationResource extends JsonResource
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
            'sale_price' => (double) $this->sale_price,
            'regular_price' => (double) $this->regular_price,
            'discount_amount' => $this->discountAmount(),
            'discount_rate' => $this->discountRate(),
            'stock_qty' => $this->stock_qty,
            'weight' => (double) $this->weight,
            'height' => (double) $this->height,
            'width' => (double) $this->width,
            'length' => (double) $this->length,
            'options' => $this->options,
            'image_url' => $this->imageUrl(), 
        ];
    }
}
