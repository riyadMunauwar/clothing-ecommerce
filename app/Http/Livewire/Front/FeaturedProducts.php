<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Product;

class FeaturedProducts extends Component
{
    
    public function render()
    {
        $products = $this->getProducts();
        return view('front.components.featured-products', compact('products'));
    }


    private function getProducts()
    {
        return Product::published()->inRandomOrder()->paginate(1);
    }
}
