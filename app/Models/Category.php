<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Product;

class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'meta_title',
        'meta_tags',
        'meta_description',
        'name',
        'slug',
        'order',
        'description',
        'parent_id',
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
                    ->quality(80);

                $this->addMediaConversion('small')
                    ->width(240)
                    ->height(240)
                    ->format('webp')
                    ->quality(80);
                    
            });
    }


    // Model Scropt

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }


    public function iconUrl($size = 'thumb')
    {
        if($this->hasMedia('icon'))
        {
            return $this->getFirstMedia('icon')->getUrl($size);
        }
        
        return 'https://via.placeholder.com/150/d32776';
    }

    // Relation
   
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }


    public function hasChildren()
    {
        return count($this->children) ?? false;
    }


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }


    public function getParentsAttribute()
    {
        $parents = collect();
        $category = $this;
        while ($category->parent) {
            $parents->prepend($category->parent);
            $category = $category->parent;
        }
        return $parents;
    }


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    

    public function menu()
    {
        return $this->hasOne(Menu::class);
    }

}
