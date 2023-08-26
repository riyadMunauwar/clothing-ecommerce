<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FooterColumn;

class FooterColumnAttribute extends Model
{
    use HasFactory;



    public function column()
    {
        return $this->belongsTo(FooterColumn::class);
    }

    // Model Scrop

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
