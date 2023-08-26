<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FooterColumnAttribute;

class FooterColumn extends Model
{
    use HasFactory;


    public function attributes()
    {
        return $this->hasMany(FooterColumnAttribute::class);
    }

    // Model Scrop

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
    
}
