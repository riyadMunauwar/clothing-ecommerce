<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class CategoryArchieve extends Component
{

    use WithPagination;

    public $categories = [];
    public $brands = [];
    public $colors = [];
    public $sizes = [];
    public $prices_ranges = [];

    public $select_category_id;
    public $select_brand_id;
    public $select_color;
    public $select_size;
    public $select_price_range;

    public $target_category;



    public function mount()
    {
        $this->setCategoryIdFromRequest();
        $this->getCategory();
        $this->initData();
    }

    public function render()
    {
        $products = $this->getProducts();

        return view('front.components.category-archieve', compact('products'));
    }

    private function initData()
    {
        $this->getCategories();
        $this->getBrands();
        $this->getColors();
        $this->getSizes();
        $this->getPriceRanges();

        dd($this->categories);
    }

    private function setCategoryIdFromRequest()
    {
        $category_id = request()->id;

        if(!$category_id) return redirct()->to('/');

        $this->select_category_id = $category_id;
    }

    private function getCategory()
    {
        $this->category = Category::find($this->select_category_id);
    }

    private function getProducts()
    {
        $this->category->products()->get();
    }

    private function getCategories()
    {
        return Category::select('id', 'name')->withCount('products')->get();
    }

    private function getBrands()
    {
        return Brand::select('id', 'name')->get();
    }

    private function getColors()
    {
        return ['Red','Green', 'Blue', 'Orange'];
    }

    private function getSizes()
    {
        return ['XS', 'S', 'M', 'L', 'XL', 'XLL', 'XLL'];
    }

    private function getPriceRanges()
    {

    }
}
