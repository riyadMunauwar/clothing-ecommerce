<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Product;

class Brand extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_featured',
        'is_published',
        'meta_title',
        'meta_tags',
        'meta_description'
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
            
            $this->addMediaConversion('thumb')
                ->width(150)
                ->height(150)
                ->format('webp')
                ->quality(80);

            $this->addMediaConversion('small')
                ->width(440)
                ->height(440)
                ->format('webp')
                ->quality(80);

        });
    }


    public function logoUrl($size = 'thumb')
    {
        if($this->hasMedia('logo'))
        {
            return $this->getFirstMedia('logo')->getUrl($size);
        }
    }

    // Model Scrop

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

}
