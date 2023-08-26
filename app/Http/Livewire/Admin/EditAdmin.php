<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;



class EditAdmin extends Component
{
    use WithSweetAlert;
    use WithSweetAlertToast;

    public $is_edit_mode_on = false;

    public $admin_id;
    public $name;
    public $email;
    public $password;
    public $confirm;
    public $role;


    public $roles = [];

    protected $rules = [
        'name' => ['required', 'string'],
        'email' => ['required', 'email'],
        'password' => ['nullable', 'string', 'min:8'],
        'role' => ['required', 'string'],
    ];


    protected $listeners = [
        'onAdminEdit' => 'enableAdminEditMode',
    ];


    public function render()
    {
        return view('admin.components.edit-admin');
    }

    public function updateAdmin()
    {
        $this->validate();

        if($this->password != $this->confirm)
        {
            return $this->errorToast('Confirm password not match!');
        }

        $user = User::find($this->admin_id);

        $user->name = $this->name;
        $user->email = $this->email;

        if($this->password)
        {
            $user->password = Hash::make($this->password);
        }
        
        if($user->save())
        {
            $user->syncRoles($this->role);
            $this->reset();
            $this->emit('onAdminUpdated');
            $this->is_edit_mode_on = false;
            return $this->success('Updated', '');
        }

        return $this->error('Failed', 'Failed to updated. Something went wrong');
    }

    public function enableAdminEditMode($id)
    {
        $this->preparedInitData();

        $user = User::find($id);

        $this->admin_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->getRoleNames()->first();

        $this->is_edit_mode_on = true;
    }

    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }


    private function preparedInitData()
    {
        $this->roles = Role::get();
    }

}
