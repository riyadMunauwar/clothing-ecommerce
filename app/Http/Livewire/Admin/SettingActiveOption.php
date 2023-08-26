<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;
use App\Traits\WithSweetAlert;

class SettingActiveOption extends Component
{
    use WithSweetAlert;

    public $setting;

    protected $rules = [
        'setting.is_top_header_active' => ['required', 'boolean'],
        'setting.is_footer_active' => ['required', 'boolean'],
        'setting.is_selling_featre_banner_active' => ['required', 'boolean'],
    ];

    public function mount()
    {
        $this->setting = Setting::firstOrCreate();
    }

    public function render()
    {
        return view('admin.components.setting-active-option');
    }

    public function saveSetting()
    {
        if($this->setting->save())
        {
            return $this->success('Saved', '');
        }

        return $this->error('Failed');
    }
}
