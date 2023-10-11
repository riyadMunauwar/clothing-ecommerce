<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;
use App\Models\Variant;
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
    public $variation_options = [];
    public $qty = 1;

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


    public function updated($attr, $value)
    {
        dd($attr, $value);
        
        if($attr === 'qty' || $attr === 'sale_price' || $attr === 'regular_price'){

        }else {
            $this->findVariant();
        }
    }

    public function AddToCart()
    {
        $cart = new CartService();

        $result = $cart->add($this->product->id, $this->variant->id ?? null, $this->qty);

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

        $this->product = Product::with('variations', 'categories', 'media')->find($produdctId);
    
        $variations = $this->product->variations;

        if(!$variations->isEmpty()){
            $this->variant = $variations->first();
            $this->sale_price = $this->variant->sale_price;
            $this->regular_price = $this->variant->regular_price;
            $this->preparedVariationOptions();
        }else {
            $this->sale_price = $this->product->sale_price;
            $this->regular_price = $this->product->regular_price;
        }
    }

    private function getRecommendationProducts()
    {
        return Product::select('id', 'slug', 'sale_price', 'regular_price', 'name')->whereNotIn('id', [$this->product->id])->inRandomOrder()->take(4)->get();
    }

    private function getRelatedProducts()
    {
        return Product::select('id', 'slug', 'sale_price', 'regular_price', 'name')->whereNotIn('id', [$this->product->id])->inRandomOrder()->take(4)->get();
    }

    private function findVariant(){

        $query = Variant::where('product_id', $this->product->id);

        foreach($this->variation_options as $option => $value){
            $query->where("attributes->{$option}", $value);
        }

        $this->variant = $query->first();

        if($this->variant){
            $this->variant = $this->variant;
            $this->sale_price = $this->variant->sale_price;
        }

    }

    private function preparedVariationOptions(){

        $queryPrams = [];


        foreach($this->product->variation_options as $key => $option){
            $queryPrams["$key"] = $option[0];
        }

        $this->variation_options = $queryPrams;
    }
}
