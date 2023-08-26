<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;

class SocialLink extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    protected $fillable = [
        'name',
        'link',
        'is_published',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                
                $this->addMediaConversion('thumb-50')
                    ->width(50)
                    ->height(50)
                    ->format('webp')
                    ->quality(100);

                $this->addMediaConversion('thumb-150')
                    ->width(150)
                    ->height(150)
                    ->format('webp')
                    ->quality(100);
                    
            });
    }


    public function iconUrl($size = 'thumb-150')
    {
        if($this->hasMedia('icon'))
        {
            return $this->getFirstMedia('icon')->getUrl($size);
        }
        
        return 'https://via.placeholder.com/150/d32776';
    }


    // Model Scrop

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
