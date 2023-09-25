<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class RecentArrivalProducts extends Component
{

    public $current_page = 1;
    public $per_page = 2;
    public $page_name = 'page';
    public $last_page = null;

    public $categories = [];

    public function mount()
    {
        $this->categories = $this->getCategories();
    }

    public function render()
    {
        $all_products = $this->getAllProducts($this->per_page, ['*'], $this->page_name, $this->current_page);

        $this->current_page = $products->currentPage();

        $this->last_page = $products->lastPage();

        return view('front.components.recent-arrival-products', compact('all_products'));
    }

    public function loadMore()
    {
        if($this->current_page < $this->last_page){
            $this->current_page++;
        }
    }

    private function getAllProducts($per_page, $wild_card, $page_name, $current_page)
    {
        return Product::published()->paginate($per_page, $wild_card, $page_name, $current_page);
    }

    private function getCategories()
    {
        return  Category::with(['products' => function ($query) {
                            $query->published()->latest()->take(10);
                    }])->published()->inRandomOrder()->take(4)->get();
    }
}
