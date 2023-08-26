<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Variation;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'qty',
        'paid_to_supplier',
        'product_id',
        'variation_id',
        'supplier_id'
    ];

    // Relationship

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
}
