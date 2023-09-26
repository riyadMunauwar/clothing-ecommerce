<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\Category;
use Illuminate\Support\Str;



class CreateCategory extends Component
{

    use WithFileUploads;
    use WithSweetAlert;

    // State
    public $categories = [];

    // From State
    public $metaTitle;
    public $metaTags;
    public $metaDescription;
    public $name;
    public $slug;
    public $parentCategoryId;
    public $icon;
    public $description;
    public $sortOrder;
    public $isPublished;
    public $isFeatured;


    protected $rules = [
        'metaTitle' => ['nullable', 'string'],
        'metaTags' => ['nullable', 'string'],
        'metaDescription' => ['nullable', 'string'],
        'name' => ['required', 'string'],
        'slug' => ['required', 'string', 'unique:categories'],
        'parentCategoryId' => ['nullable', 'string'],
        'icon' => ['nullable'],
        'description' => ['nullable', 'string'],
        'sortOrder' => ['nullable', 'integer'],
        'isPublished' => ['nullable', 'boolean'],
        'isFeatured' => ['nullable', 'boolean'],
    ];


    public function mount()
    {
        $this->preparedInitialState();
    }


    public function render()
    {
        return view('admin.components.create-category');
    }


    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }


    public function createCategory()
    {
        $this->validate();

        $category = Category::create([
            'meta_title' => $this->metaTitle,
            'meta_tags' => $this->metaTags,
            'meta_description' => $this->metaDescription,
            'name' => $this->name,
            'slug' => $this->slug,
            'parent_id' => $this->parentCategoryId,
            'description' => $this->description,
            'sort_order' => $this->sortOrder,
            'is_published' => $this->isPublished,
            'is_featured' => $this->isFeatured,
        ]);


        if(!$category) return $this->error('Failed', 'Failed to create category. Try again');

        if($this->icon)
        {
            $category->addMedia($this->icon)->toMediaCollection('icon');
        }

        if($category){
            $this->reset();
            $this->preparedInitialState();
            $this->emit('onCategoryCreated');
            return $this->success('Success', 'Category created successfully');
        }

    }


    public function removeIcon()
    {
        $this->icon->delete();
        $this->icon = null;
    }


    public function preparedInitialState()
    {
        $this->categories = Category::with('children')->whereNull('parent_id')->get();
    }

}
