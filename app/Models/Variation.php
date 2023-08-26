<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Product;

class Variation extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'sale_price',
        'regular_price',
        'weight',
        'weight_unit',
        'height',
        'length',
        'width',
        'dimension_unit',
        'stock_qty',
        'sku',
        'options',
        'product_id',
        'is_published',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
        ->singleFile()
        ->registerMediaConversions(function (Media $media = null) {
            
            $this->addMediaConversion('thumb')
                ->width(150)
                ->height(150)
                ->format('webp')
                ->quality(80);

            $this->addMediaConversion('small')
                ->width(640)
                ->height(640)
                ->format('webp')
                ->quality(80);

            $this->addMediaConversion('medium')
                ->width(800)
                ->height(800)
                ->format('webp')
                ->quality(80);
                
        });
    }

    public function imageUrl($size = 'small')
    {
        if($this->hasMedia('image')){
            return $this->getFirstMedia('image')->getUrl($size);
        }
    }


    public function discountAmount()
    {
        if(! ($this->regular_price && $this->sale_price)) return 0;

        return $this->regular_price - $this->sale_price;
    }
    

    public function discountRate()
    {
        if(!($this->regular_price && $this->sale_price )) return 0;

        $discountRate = ( ($this->regular_price - $this->sale_price) * 100 ) / $this->regular_price;

        return (int) $discountRate . '%';
    }

    // Relationship

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Model Scope

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

}
