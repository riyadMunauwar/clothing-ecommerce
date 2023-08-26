<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\Banner;

class CreateBanner extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    // From State
    public $name;
    public $show_in_page;
    public $banner_link;
    public $is_published = true;
    public $image;

    protected $rules = [
        'name' => ['required', 'string', 'unique:banners'],
        'show_in_page' => ['required', 'string', 'unique:banners'],
        'banner_link' => ['nullable', 'string'],
        'is_published' => ['required', 'boolean'],
        'image' => ['nullable', 'image'],
    ];

    public function render()
    {
        return view('admin.components.create-banner');
    }


    public function createBanner()
    {
        $this->validate();

        $banner = Banner::create([
            'name' => $this->name,
            'show_in_page' => $this->show_in_page,
            'banner_link' => $this->banner_link,
            'is_published' => $this->is_published,
        ]);

        if(!$banner) return $this->error('Failed', 'Failed to create Banner. Try again');

        if($this->image){
            $banner->addMedia($this->image)->toMediaCollection('image');
        }

        $this->reset();
        $this->emit('onBannerCreated');
        return $this->success('Created', 'Banner created successfully');

    }


    public function removeImage()
    {
        $this->image->delete();
        $this->image = null;
    }

}
