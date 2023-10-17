<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\User;
use App\Traits\WithSweetAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerProfileSetting extends Component
{
    use WithSweetAlert;

    public $user;


    public $newPassword;
    public $currentPassword;
    public $confirmPassword;


    protected $rules = [
        'user.name' => ['required', 'string', 'max:255'],
        'user.email' => ['required', 'string', 'email', 'max:255'],
        'newPassword' => ['nullable', 'string'],
        'currentPassword' => ['nullable', 'string', 'min:8', 'max:255'],
        'confirmPassword' => ['nullable', 'string', 'min:8', 'max:255', 'same:newPassword'],
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
        $this->validate();

        // if(!$this->checkIsOldPassCorrect()){
        //     return $this->error('Your current password is wrong.', ' ');
        // }


        $newPassword = Hash::make($this->newPassword);

        if($this->newPassword){
            $this->user->password = $newPassword;
        }

        $this->user->save();

        $this->resetField();

        if($this->newPassword){
            Auth::login($this->user);
        }

        return $this->success('Profie updated', '');

    }

    private function resetField()
    {
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->oldPassword = '';
    }


    private function checkIsOldPassCorrect()
    {
        $currentDbPass = $this->user->password;
        $currentUserProvidePass = Hash::make($this->currentPassword);

        return Hash::check($currentDbPass, $currentUserProvidePass);
    }
}
