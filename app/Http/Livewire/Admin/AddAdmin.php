<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;



class AddAdmin extends Component
{
    use WithSweetAlert;
    use WithSweetAlertToast;

    public $is_add_admin_modal_open = false;

    public $name;
    public $email;
    public $password;
    public $confirm;
    public $role;

    public $roles = [];

    protected $rules = [
        'name' => ['required', 'string'],
        'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
        'role' => ['required', 'string'],
    ];


    protected $listeners = [
        'onOpenAddNewAdminModal' => 'openAddAdminModal'
    ];


    public function render()
    {
        return view('admin.components.add-admin');
    }

    public function addNewAdmin()
    {
        $this->validate();

        if($this->password != $this->confirm)
        {
            return $this->errorToast('Confirm password not match!');
        }

        $user = new User();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        
        if($user->save())
        {
            $user->assignRole($this->role);
            $this->reset();
            $this->emit('onAdminCreated');
            $this->is_add_admin_modal_open = false;
            return $this->success('Created', '');
        }

        return $this->error('Failed', 'Failed to create. Something went wrong');
    }

    public function openAddAdminModal()
    {
        $this->preparedInitData();
        $this->is_add_admin_modal_open = true;
    }

    public function closeAddAdminModal()
    {
        $this->reset();
        $this->is_add_admin_modal_open = false;
    }


    private function preparedInitData()
    {
        $this->roles = Role::get();
    }

}
