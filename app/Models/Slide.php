<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Caurosel;


class Slide extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'caurosel_id',
        'slide_link',
        'is_published',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                
                $this->addMediaConversion('image')
                    ->width(1976)
                    ->height(688)
                    ->format('webp')
                    ->quality(90);
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


    // Model Scope

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }


    // Relationship

    public function caurosel()
    {
        return $this->belongsTo(Caurosel::class);
    }

}
