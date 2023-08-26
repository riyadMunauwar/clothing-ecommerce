<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Traits\WithSweetAlert;

class EditBrand extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    public $isEditModeOn = false;
    public $new_logo;
    public $old_logo;

    public $brand;


    protected $listeners = [
        'onBrandEdit' => 'enableBrandEditMode',
    ];


    protected $rules = [
        'brand.meta_title' => ['nullable', 'string'],
        'brand.meta_tags' => ['nullable', 'string'],
        'brand.meta_description' => ['nullable', 'string'],
        'brand.name' => ['required', 'string'],
        'brand.slug' => ['required', 'string'],
        'brand.description' => ['nullable', 'string'],
        'brand.is_published' => ['required', 'boolean'],
        'brand.is_featured' => ['required', 'boolean'],
    ];


    public function render()
    {
        return view('admin.components.edit-brand');
    }


    public function updated($property, $value)
    {

        if($property === 'brand.name')
        {
            $this->brand->slug = Str::slug($value);
        }
        
    }
    

    public function updateBrand()
    {

        $this->validate();

        if($this->new_logo){
            $this->brand->addMedia($this->new_logo)->toMediaCollection('logo');
        }


        if($this->brand->save()){

            $this->reset();

            $this->isEditModeOn = false;

            $this->emit('onBrandUpdated');

            return $this->success('Updated', 'Brand updated successfully');
        }
        
        return $this->error('Failed', 'Something went wrong. Try again !');

    }


    public function enableBrandEditMode($id)
    {

        $this->brand = Brand::find($id);

        $this->old_logo = $this->brand->logoUrl('thumb');

        $this->isEditModeOn = true;

    }


    public function removeIcon()
    {
        $this->new_logo->delete();
        $this->new_logo = null;
    }


    public function cancelEditMode()
    {
        $this->reset();
        $this->isEditModeOn = false;
    }

}
