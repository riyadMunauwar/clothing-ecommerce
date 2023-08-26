<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\SocialLink;

class EditSocialLink extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    public $is_edit_mode_on = false;

    public $social_link;

    public $old_icon;
    public $new_icon;

    protected $rules = [
        'social_link.name' => ['required', 'string'],
        'social_link.link' => ['nullable', 'string', ],
        'social_link.is_published' => ['required', 'boolean'],
    ];


    protected $listeners = [
        'onSocialLinkEdit' => 'enableSocialLinkEditMode',
    ];

    public function render()
    {
        return view('admin.components.edit-social-link');
    }

    public function updateSocialLink()
    {

        $this->validate();

        if($this->new_icon){
            $this->social_link->addMedia($this->new_icon)->toMediaCollection('icon');
        }

        if($this->social_link->save()){

            $this->reset();

            $this->is_edit_mode_on = false;

            $this->emit('onSocialLinkUpdated');

            return $this->success('Updated', 'Social link updated successfully');
        }
        
        return $this->error('Failed', 'Something went wrong. Try again !');

    }


    public function enableSocialLinkEditMode($id)
    {

        $this->social_link = SocialLink::find($id);

        $this->old_icon = $this->social_link->iconUrl('thumb-150');

        $this->is_edit_mode_on = true;

    }


    public function removeIcon()
    {
        $this->new_icon->delete();
        $this->new_icon = null;
    }


    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }
}
