<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Category;

class BrowseCategories extends Component
{

    public $categories = [];

    public function mount()
    {
        $this->categories = $this->getFeaturedCategories();
    }

    public function render()
    {
        return view('front.components.browse-categories');
    }

    public function goToCategory($categoryId)
    {
        dd($categoryId);
    }

    private function getFeaturedCategories()
    {
        return Category::withCount('products')->published()->where('parent_id', null)->get();
    }

}
