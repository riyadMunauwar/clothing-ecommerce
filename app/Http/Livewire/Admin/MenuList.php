<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Menu;

class MenuList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onMenuCreated' => '$refresh',
        'onMenuUpdated' => '$refresh',
        'onMenuDelete' => 'deleteMenu',
    ];


    public function render()
    {
        $menus = $this->getMenus();

        return view('admin.components.menu-list', compact('menus'));
    }


    public function enableMenuEditMode($id)
    {
        $this->emit('onMenuEdit', $id);
    }


    public function confirmDeleteMenu($id)
    {
        return $this->ifConfirmThenDispatch('onMenuDelete', $id, 'Are you sure ?', 'Menu will delete permanently !');
    }


    public function deleteMenu($id)
    {
        if(Menu::destroy($id)){
            return $this->success('Success', 'Menu deleted successfully.');
        }

        return $this->error('Failed', 'Failed to delete Menu. try again');
    }


    private function getMenus()
    {

        $search = $this->search;

        $query = Menu::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('name', $search);
        });

        return $query->paginate(25);

    }
}
