<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Models\Product;

class FeaturedProducts extends Component
{

    public $current_page = 1;
    public $per_page = 8;
    public $page_name = 'page';
    public $last_page = null;


    public function render()
    {
        $products = $this->getProducts($this->per_page, ['*'], $this->page_name, $this->current_page);

        $this->current_page = $products->currentPage();

        $this->last_page = $products->lastPage();

        return view('front.components.featured-products', compact('products'));
    }


    public function loadMore()
    {
        if($this->current_page < $this->last_page){
            $this->current_page++;
        }
    }


    private function getProducts($per_page, $wild_card, $page_name, $current_page)
    {
        return Product::published()->paginate($per_page, $wild_card, $page_name, $current_page);
    }
}
