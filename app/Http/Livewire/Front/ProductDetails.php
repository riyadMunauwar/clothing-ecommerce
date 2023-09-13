<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;

class ProductDetails extends Component
{
    public $product;
    public $recommendation_products = [];
    public $related_products = [];

    public function mount()
    {   
        $this->product = $this->getProduct();
        $this->recommendation_products = $this->getRecommendationProducts();
        $this->related_products = $this->getRelatedProducts();
    }

    public function render()
    {
        return view('front.components.product-details');
    }

    private function getProduct()
    {
        $produdctId = request()->id;

        if(!$produdctId) redirect()->to('/');

        return Product::find($produdctId);
    }

    private function getRecommendationProducts()
    {
        return Product::select('id', 'slug', 'sale_price', 'regular_price')->whereNotIn('id', [$this->product->id])->inRandomOrder()->take(4)->get();
    }

    private function getRelatedProducts()
    {
        return Product::select('id', 'slug', 'sale_price', 'regular_price')->whereNotIn('id', [$this->product->id])->inRandomOrder()->take(4)->get();
    }
}
