<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Category;

class FeaturedCategoryShowcase extends Component
{

    public $featured_category_one;
    public $featured_category_two;
    public $featured_category_three;
    public $featured_category_four;
    public $featured_category_five;
    public $featured_category_six;
    public $featured_category_seven;
    public $featured_category_eight;

    public function mount()
    {

    }

    public function render()
    {
        return view('front.components.featured-category-showcase');
    }

    private function getFeaturedCategories()
    {
        $this->featured_category_one = Category::published()->featured()->first();

        if($this->featured_category_one){
            $this->featured_category_two = Category::published()->featured()->whereNotIn('id', [$this->featured_category_one->id])->first();
        }

        if($this->featured_category_two){
            $this->featured_category_three = Category::published()->featured()->whereNotIn('id', [$this->featured_category_two->id])->first();
        }

        if($this->featured_category_three){
            $this->featured_category_four = Category::published()->featured()->whereNotIn('id', [$this->featured_category_three->id])->first();
        }
        
        if($this->featured_category_four){
            $this->featured_category_five = Category::published()->featured()->whereNotIn('id', [$this->featured_category_four->id])->first();
        }

        if($this->featured_category_five){
            $this->featured_category_six = Category::published()->featured()->whereNotIn('id', [$this->featured_category_five->id])->first();
        }

        if($this->featured_category_six){
            $this->featured_category_seven = Category::published()->featured()->whereNotIn('id', [$this->featured_category_six->id])->first();
        }

        if($this->featured_category_seven){
            $this->featured_category_eight = Category::published()->featured()->whereNotIn('id', [$this->featured_category_seven->id])->first();
        }
        
    }


}
