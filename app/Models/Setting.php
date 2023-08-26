<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('favicon')
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                
                $this->addMediaConversion('favicon')
                    ->width(48)
                    ->height(48)
                    ->format('webp')
                    ->quality(100);
                    
            });


            $this->addMediaCollection('logo')
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                
                $this->addMediaConversion('square')
                    ->width(160)
                    ->height(160)
                    ->format('webp')
                    ->quality(100);
                
                $this->addMediaConversion('horizontal-small')
                    ->width(250)
                    ->height(150)
                    ->format('webp')
                    ->quality(100);

                $this->addMediaConversion('horizontal-medium')
                    ->width(350)
                    ->height(75)
                    ->format('webp')
                    ->quality(100);

                $this->addMediaConversion('horizontal-large')
                    ->width(400)
                    ->height(100)
                    ->format('webp')
                    ->quality(100);
                    
            });
    }


    public function faviconUrl($size = 'favicon')
    {
        if($this->hasMedia('favicon'))
        {
            return $this->getFirstMedia('favicon')->getUrl($size);
        }
        
        return 'https://via.placeholder.com/150/d32776';
    }


    public function logoUrl($size = 'horizontal-large')
    {
        if($this->hasMedia('logo'))
        {
            return $this->getFirstMedia('logo')->getUrl($size);
        }
        
        return 'https://via.placeholder.com/150/d32776';
    }
}
