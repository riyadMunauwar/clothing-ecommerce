<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use LaracraftTech\LaravelDateScopes\DateScopes;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Variation;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use DateScopes;  

    protected $fillable = [
        'meta_title',
        'meta_tags',
        'meta_description',
        'name',
        'slug',
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
        'short_description',
        'description',
        'youtube_video_url',
        'youtube_video_id',
        'variation_options',
        'is_published',
        'is_ebnshop_own_item',
        'is_grocery',
        'brand_id'
    ];

    protected $casts = [
        'variation_options' => 'array',
    ];
    

    public function registerMediaCollections(): void
    {

        $this->addMediaCollection('thumbnail')
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

        $this->addMediaCollection('gallery')
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


    public function thumbnailUrl($size = 'small')
    {
        if($this->hasMedia('thumbnail')){
            return $this->getFirstMedia('thumbnail')->getUrl($size);
        }
        return '';
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


    public function galleryImage()
    {
        $gallery_items = [];

        foreach($this->getMedia('gallery') as $media)
        {
            array_push($gallery_items, [
                'thumb' => $media->getUrl('thumb'),
                'small' => $media->getUrl('small'),
                'medium' => $media->getUrl('medium'),
            ]);
        }

        return $gallery_items;
    }


    // Relationship
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    // Model Scope

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

}
