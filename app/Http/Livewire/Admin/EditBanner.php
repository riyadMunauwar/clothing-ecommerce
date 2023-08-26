<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\Banner;

class EditBanner extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    public $is_edit_mode_on = false;

    public $banner;

    public $old_image;
    public $new_image;

    protected $rules = [
        'banner.name' => ['required', 'string'],
        'banner.show_in_page' => ['required', 'string', ],
        'banner.banner_link' => ['nullable', 'string', ],
        'banner.is_published' => ['required', 'boolean'],
    ];


    protected $listeners = [
        'onBannerEdit' => 'enableBannerEditMode',
    ];

    public function render()
    {
        return view('admin.components.edit-banner');
    }

    public function updateBanner()
    {

        $this->validate();

        if($this->new_image){
            $this->banner->addMedia($this->new_image)->toMediaCollection('image');
        }

        if($this->banner->save()){

            $this->reset();

            $this->is_edit_mode_on = false;

            $this->emit('onBannerUpdated');

            return $this->success('Updated', 'Banner updated successfully');
        }
        
        return $this->error('Failed', 'Something went wrong. Try again !');

    }


    public function enableBannerEditMode($id)
    {

        $this->banner = Banner::find($id);

        $this->old_image = $this->banner->imageUrl('image');

        $this->is_edit_mode_on = true;

    }


    public function removeImage()
    {
        $this->new_image->delete();
        $this->new_image = null;
    }


    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }
}
