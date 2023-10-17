<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\User;
use App\Traits\WithSweetAlert;

class CustomerProfileSetting extends Component
{
    use WithSweetAlert;

    public $user;


    protected $rules = [
        'user.name' => ['required', 'string', 'max:255'],
        'user.email' => ['required', 'string', 'email', 'max:255'],
        'newPassword' => ['required', 'string', 'min:8', 'max:255', 'max:255'],
        'currentPassword' => ['required', 'string', 'min:8', 'max:255'],
        'confirmPassword' => ['required', 'string', 'min:8', 'max:255', 'same:newPassword'],
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }
    
    public function render()
    {
        return view('front.components.customer-profile-setting');
    }

    public function saveChanges()
    {
        
    }
}
