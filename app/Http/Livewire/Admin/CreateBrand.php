<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Brand;
use App\Traits\WithSweetAlert;
use Illuminate\Support\Str;

class CreateBrand extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    public $new_logo;
    public $name;
    public $slug;
    public $description;
    public $meta_title;
    public $meta_tags;
    public $meta_description;
    public $is_featured = false;
    public $is_published = true;



    protected $rules = [
        'new_logo' => ['required', 'image'],
        'name' => ['required', 'string'],
        'slug' => ['required', 'string', 'unique:brands'],
        'description' => ['nullable', 'string'],
        'meta_title' => ['nullable', 'string'],
        'meta_tags' => ['nullable', 'string'],
        'meta_description' => ['nullable', 'string'],
        'is_published' => ['required', 'boolean'],
        'is_featured' => ['required', 'boolean'],
    ];


    public function render()
    {
        return view('admin.components.create-brand');
    }


    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }


    public function removeLogo()
    {
        $this->new_logo->delete();
        $this->new_logo = null;
    }


    public function createBrand()
    {

        $this->validate();

        $brand = Brand::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_tags' => $this->meta_tags,
            'meta_description' => $this->meta_description,
            'is_published' => $this->is_published,
            'is_featured' => $this->is_featured,
        ]);

        if($brand && $this->new_logo){
            $brand->addMedia($this->new_logo)->toMediaCollection('logo');
        }

        if($brand) {

            $this->reset();
            $this->emit('onBrandCreated');
            return $this->success('Created', '');

        }

        return $this->error('Failed', 'Failed to create. Something went wrong');

    }

}
