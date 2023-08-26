<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\User;

class AdminList extends Component
{

    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onAdminCreated' => '$refresh',
        'onAdminUpdated' => '$refresh',
        'onAdminDelete' => 'deleteAdmin',
    ];


    public function render()
    {
        $admins = $this->getAdmins();

        return view('admin.components.admin-list', compact('admins'));
    }


    public function enableAdminEditMode($id)
    {
        $this->emit('onAdminEdit', $id);
    }

    public function openAddNewAdminModal()
    {
        $this->emit('onOpenAddNewAdminModal');
    }

    public function confirmDeleteAdmin($id)
    {
        return $this->ifConfirmThenDispatch('onAdminDelete', $id, 'Are you sure ?', 'Admin will delete permanently !');
    }


    public function deleteAdmin($id)
    {
        try {

            if(User::destroy($id)){
                return $this->success('Success', 'Admin deleted successfully.');
            }
    
        }catch(\Exception $e)   
        {
            return $this->error('Failed', 'This user has relation with order. Delete order first.');
        }
    }


    private function getAdmins()
    {

        $search = $this->search;

        $query = User::role(['admin', 'manager', 'editor']);

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('name', $search)
                  ->where('email', 'like', '%' . $search . '%')
                  ->orWhere('email', $search);
        });

        return $query->paginate(25);

    }
}
