<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class RecentArrivalProducts extends Component
{

    public $categories = [];
    public $all_products = [];

    public function mount()
    {
        $this->categories = $this->getCategories();
        $this->all_products = $this->getAllProducts();
    }

    public function render()
    {
        return view('front.components.recent-arrival-products');
    }

    private function getAllProducts()
    {
        return Product::published()->latest()->inRandomOrder()->take(8)->get();
    }

    private function getCategories()
    {
        return  Category::with(['products' => function ($query) {
                            $query->published()->latest()->take(10);
                    }])->published()->inRandomOrder()->take(4)->get();
    }
}
