<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Services\Cart\CartService;

class ProductDetails extends Component
{

    use WithSweetAlert;

    public $product;
    public $variant;
    public $recommendation_products = [];
    public $related_products = [];

    public $sale_price = 0;
    public $regular_price = 0;
    public $viration_options;

    public function mount()
    {   
        $this->setProductAndVariation();
        $this->recommendation_products = $this->getRecommendationProducts();
        $this->related_products = $this->getRelatedProducts();
    }

    public function render()
    {
        return view('front.components.product-details');
    }


    public function AddToCart()
    {
        $cart = new CartService();

        $result = $cart->add($this->product->id, null, 1);

        if(!$result['isError']){
            $this->emit('onCartItemChanges');

            return $this->success('Item added to cart', $result['message']);
        }else {
            return $this->info('Sorry !', $result['message']);
        }
    }

    private function setProductAndVariation()
    {
        $produdctId = request()->id;

        if(!$produdctId) redirect()->to('/');

        $this->product = Product::with('variations', 'category', 'media')->find($produdctId);
    
        $variations = $this->product->variations;

        dd($variations);
    }

    private function getRecommendationProducts()
    {
        return Product::select('id', 'slug', 'sale_price', 'regular_price', 'name')->whereNotIn('id', [$this->product->id])->inRandomOrder()->take(4)->get();
    }

    private function getRelatedProducts()
    {
        return Product::select('id', 'slug', 'sale_price', 'regular_price', 'name')->whereNotIn('id', [$this->product->id])->inRandomOrder()->take(4)->get();
    }
}
