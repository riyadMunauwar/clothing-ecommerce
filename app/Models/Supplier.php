<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Purchase;

class Supplier extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'city',
        'state',
        'country',
        'address',
        'phone',
        'email',
        'contact_person_name',
        'contact_person_phone',
        'contact_person_email',
    ];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                
                $this->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100)
                    ->format('webp')
                    ->quality(80);

                $this->addMediaConversion('small')
                    ->width(240)
                    ->height(240)
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
        
        return 'https://via.placeholder.com/150/d32776';
    }


    // Relationship

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }


    // Model Scrop

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

}
