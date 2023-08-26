<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\Setting;

class GeneralSetting extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    public $new_favicon;
    public $old_favicon;
    public $new_logo;
    public $old_logo;

    public $setting;

    protected $rules = [
        'setting.website_name' => ['nullable', 'string'],
        'setting.website_email' => ['nullable', 'email'],
        'setting.website_phone' => ['nullable', 'string'],
        'setting.address' => ['nullable', 'string'],
        'setting.meta_title' => ['nullable', 'string'],
        'setting.meta_tags' => ['nullable', 'string'],
        'setting.meta_description' => ['nullable', 'string'],
    ];

    public function mount()
    {
        $this->setting = Setting::firstOrCreate();
        $this->old_favicon = $this->setting->faviconUrl();
        $this->old_logo = $this->setting->logoUrl();
    }

    public function render()
    {
        return view('admin.components.general-setting');
    }


    public function saveSetting()
    {
        $this->validate();

        if($this->new_logo)
        {
            $this->setting->addMedia($this->new_logo)->toMediaCollection('logo');
        }

        if($this->new_favicon)
        {
            $this->setting->addMedia($this->new_favicon)->toMediaCollection('favicon');
        }

        if($this->setting->save())
        {
            
            if($this->new_logo)
            {
                $this->old_logo = $this->setting->logoUrl();
            }

            if($this->new_favicon)
            {
                $this->old_favicon = $this->setting->faviconUrl();
            }

            $this->new_logo = null;
            $this->new_favicon = null;

            return $this->success('Saved', '');
        }

        return $this->error('Failed', 'Failed to save');

    }


    public function removeFavicon()
    {
        $this->new_favicon->delete();
        $this->new_favicon = null;
    }

    public function removeLogo()
    {
        $this->new_logo->delete();
        $this->new_logo = null;
    }

}
