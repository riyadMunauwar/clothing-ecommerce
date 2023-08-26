<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'show_in_page',
        'banner_link',
        'is_published', 
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                
                $this->addMediaConversion('image')
                    ->width(1500)
                    ->height(305)
                    ->format('webp')
                    ->quality(95);

            });
    }


    public function imageUrl($size = 'image')
    {
        if($this->hasMedia('image'))
        {
            return $this->getFirstMedia('image')->getUrl($size);
        }
        
        return '';
    }

    // Model Scrop
    
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }


}
