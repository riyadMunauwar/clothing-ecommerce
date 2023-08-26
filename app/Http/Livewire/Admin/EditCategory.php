<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Traits\WithSweetAlert;


class EditCategory extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    public $categories = [];
    public $isEditModeOn = false;
    public $newIcon;
    public $oldIcon;

    public $category;


    protected $listeners = [
        'onCategoryEdit' => 'enableCategoryEditMode',
    ];


    protected $rules = [
        'category.meta_title' => ['nullable', 'string'],
        'category.meta_tags' => ['nullable', 'string'],
        'category.meta_description' => ['nullable', 'string'],
        'category.name' => ['required', 'string'],
        'category.slug' => ['required', 'string'],
        'category.description' => ['nullable', 'string'],
        'category.order' => ['nullable', 'integer'],
        'category.parent_id' => ['nullable', 'integer'],
        'category.is_published' => ['nullable', 'boolean'],
    ];

    public function mount()
    {
        $this->preparedInitState();
    }


    public function render()
    {
        return view('admin.components.edit-category');
    }


    public function updated($property, $value)
    {

        if($property === 'category.name')
        {
            $this->category->slug = Str::slug($value);
        }
        
    }
    

    public function updateCategory()
    {

        $this->validate();

        if($this->newIcon){
            $this->category->addMedia($this->newIcon)->toMediaCollection('icon');
        }


        if($this->category->save()){

            $this->reset();

            $this->isEditModeOn = false;

            $this->emit('onCategoryUpdated');

            return $this->success('Updated', 'Category updated successfully');
        }
        
        return $this->error('Failed', 'Something went wrong. Try again !');

    }


    public function enableCategoryEditMode($id)
    {
        $this->preparedInitState();

        $this->category = Category::find($id);

        $this->oldIcon = $this->category->iconUrl('thumb');

        $this->isEditModeOn = true;

    }


    public function removeIcon()
    {
        $this->newIcon->delete();
        $this->newIcon = null;
    }


    public function cancelEditMode()
    {
        $this->reset();
        $this->isEditModeOn = false;
    }


    private function preparedInitState()
    {
        $this->categories = Category::all();
    }

}
