<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Models\Menu;

class MenuList extends Component
{
    use WithSweetAlert;


    protected $listeners = [
        'onMenuCreated' => '$refresh',
        'onMenuUpdated' => '$refresh',
        'onMenuDelete' => 'deleteMenu',
    ];


    public function render()
    {
        return view('admin.components.menu-list');
    }


    public function enableMenuEditMode($id)
    {
        $this->emit('onMenuEdit', $id);
    }

    public function enableAddNewMenuModal($parent_id)
    {
        $this->emit('onShowCreateMenuModal', $parent_id);
    }


    public function confirmDeleteMenu($id)
    {
        return $this->ifConfirmThenDispatch('onMenuDelete', $id, 'Are you sure ?', 'Menu will delete permanently !');
    }


    public function deleteMenu($id)
    {
        try {
            if(Menu::destroy($id)){
                return $this->success('Success', 'Menu deleted successfully.');
            }
        }catch(\Exception $e){
            return $this->error('Failed', 'Delete child menu first.');
        }

    }

}
