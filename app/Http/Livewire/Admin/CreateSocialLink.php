<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\SocialLink;

class CreateSocialLink extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    // From State
    public $name;
    public $link;
    public $is_published = false;
    public $icon;

    protected $rules = [
        'name' => ['required', 'string', 'unique:social_links'],
        'link' => ['nullable', 'string'],
        'is_published' => ['required', 'boolean'],
        'icon' => ['nullable', 'image'],
    ];

    public function render()
    {
        return view('admin.components.create-social-link');
    }


    public function createSocialLink()
    {
        $this->validate();

        $socialLink = SocialLink::create([
            'name' => $this->name,
            'link' => $this->link,
            'is_published' => $this->is_published,
        ]);

        if(!$socialLink) return $this->error('Failed', 'Failed to create social link. Try again');

        if($this->icon){
            $socialLink->addMedia($this->icon)->toMediaCollection('icon');
        }

        $this->reset();
        $this->emit('onSocialLinkCreated');
        return $this->success('Created', 'social link created successfully');

    }


    public function removeIcon()
    {
        $this->icon->delete();
        $this->icon = null;
    }

}
