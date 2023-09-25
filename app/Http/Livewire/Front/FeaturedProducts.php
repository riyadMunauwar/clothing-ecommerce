<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Product;

class FeaturedProducts extends Component
{
    use WithPagination;

    public $products = null;
    public $current_page = 1;
    public $per_page = 1;
    public $page_name = 'page';
    public $last_page = null;


    public function initProducts()
    {
        if(!$this->products){
            $this->products = collect([]);
        }

        $products = $this->getProducts($this->per_page, ['*'], $this->page_name, $this->current_page);

        $this->current_page = $products->currentPage();

        $this->last_page = $products->lastPage();

        foreach($products as $product){
            $this->products->push($product);
        }

    }

    public function render()
    {
        $this->initProducts();
        return view('front.components.featured-products');
    }


    public function loadMore()
    {
        if($this->current_page < $this->last_page){
            $this->current_page++;
        }
    }


    private function getProducts($per_page, $wild_card, $page_name, $current_page)
    {
        return Product::published()->inRandomOrder()->paginate($per_page, $wild_card, $page_name, $current_page);
    }
}
