<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;

class ProductDetails extends Component
{
    public $product;

    public function mount()
    {   
        $this->product = $this->getProduct();
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
}
