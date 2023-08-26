<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Category;

class Menu extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    protected $fillable = [
        'name',
        'link',
        'order',
        'category_id',
        'is_published'
    ];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                
                $this->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100)
                    ->format('webp')
                    ->quality(100);
                    
            });
    }


    public function iconUrl($size = 'thumb')
    {
        if($this->hasMedia('icon'))
        {
            return $this->getFirstMedia('icon')->getUrl($size);
        }
        
        return 'https://via.placeholder.com/150/d32776';
    }


    public function category()
    {
        return $this->belongsTo(Category::class)->with('children');
    }

    // Model Scrop

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

}
