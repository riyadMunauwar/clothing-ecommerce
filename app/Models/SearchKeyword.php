<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchKeyword extends Model
{
    use HasFactory;

    protected $fillable = [
        'keyword',
        'results',
        'hits'
    ];

    public static function getLastSearchKeywords($limit = 15, $hours = 24)
    {
        return static::query()
            ->where('updated_at', '>=', now()->subHours($hours))
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
