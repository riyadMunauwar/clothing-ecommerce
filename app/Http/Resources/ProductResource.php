<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\VariationResource;

class ProductResource extends JsonResource
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
            'meta_title' => $this->meta_title,
            'meta_tags' => $this->meta_tags,
            'meta_description' => $this->meta_description,
            'name' => $this->name,
            'slug' => $this->slug,
            'regular_price' => (double) $this->regular_price,
            'sale_price' => (double) $this->sale_price,
            'discount_amount' => $this->discountAmount(),
            'discount_rate' => $this->discountRate(),
            'weight' => (double) $this->weight,
            'width' => (double) $this->width,
            'height' => (double) $this->height,
            'length' => (double) $this->length,
            'sku' => $this->sku,
            'stock_qty' => $this->stock_qty,
            'thumbnail_url' => $this->thumbnailUrl('medium'),
            'gallery' => $this->galleryImage(),
            'youtube_video_id' => $this->youtube_video_id,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'variation_options' => $this->variation_options,
            'variations' => VariationResource::collection($this->variations),

            'brand' => $this->when($this->brand->id ?? false, [
                'id' => $this->id,
                'name' => $this->name,
                'slug' => $this->slug,
            ]),

            'categories' => $this->when($this->categories->count(), $this->categories->map(function($item) {
                return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'slug' => $item->slug,
                    ];
            })),

            'is_premium' => $this->is_premium ? true : false,
            'is_featured' => $this->is_featured ? true : false,
            'is_grocery' => $this->is_grocery ? true : false,
        ];
    }
}
