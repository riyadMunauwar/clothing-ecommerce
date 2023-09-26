<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Category;

class FeaturedCategoryShowcase extends Component
{

    public $categories = [];

    public function mount()
    {
        $this->categories = $this->getFeaturedCategories();
    }

    public function render()
    {
        return view('front.components.featured-category-showcase');
    }

    private function getFeaturedCategories()
    {
        return Category::withCount('products')->published()->featured()->take(8);
    }


}
