<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'meta_title',
        'meta_tags',
        'meta_description',
        'is_published',
    ];
    
    // Model Scrop

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
