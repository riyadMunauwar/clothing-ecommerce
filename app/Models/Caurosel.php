<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Slide;

class Caurosel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'show_in_page',
        'is_published'
    ];

    // Model Scope

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }


    public function slides()
    {
        return $this->hasMany(Slide::class);
    }
    
}
