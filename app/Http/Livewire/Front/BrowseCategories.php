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
        $children = $this->findChildren($categoryId);

        if($children->isEmpty())
        {
            $category = Category::select('id', 'slug')->find($categoryId);

            return redirect()->route('category', ['category_slug' => $category->slug, 'id' => $category->id]);
        }else {
            $this->categories = $children;
        }
    }


    private function findChildren($id)
    {
        return Category::select('id', 'name')->withCount('products')->published()->where('parent_id', $id)->get();
    }

    private function getFeaturedCategories()
    {
        return Category::select('id', 'name')->withCount('products')->published()->where('parent_id', null)->get();
    }

}
