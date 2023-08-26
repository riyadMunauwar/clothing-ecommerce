<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Models\Setting;

class HeaderSetup extends Component
{
    use WithSweetAlert;

    public $new_favicon;
    public $old_favicon;
    public $new_logo;
    public $old_logo;

    public $setting;

    protected $rules = [
        'setting.top_header_message_text' => ['nullable', 'string'],
        'setting.top_header_message_text_link' => ['nullable', 'string'],
        'setting.top_header_button_text' => ['nullable', 'string'],
        'setting.top_header_button_text_link' => ['nullable', 'string'],
    ];

    public function mount()
    {
        $this->setting = Setting::firstOrCreate();
    }

    public function render()
    {
        return view('admin.components.header-setup');
    }


    public function saveSetting()
    {
        $this->validate();

        if($this->setting->save())
        {
            return $this->success('Saved', '');
        }

        return $this->error('Failed', 'Failed to save');

    }

}
