<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache; 

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
        $menus = $this->getMenus();

        
        return view('admin.components.menu-list', compact('menus'));
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


    private function getMenus()
    {
        $cacheKey = config('cache_keys.admin_menu_create_items');

        $menus = Cache::remember($cacheKey, config('cache.cache_ttl'), function(){
            return $this->getMenuTree();
        });

        return $menus;
    }

 
    private function getMenuTree($parentId = null) {
        
        $menuItems = Menu::with('category')
            ->where('parent_id', $parentId)
            ->where('is_published', true)
            ->get();
    
        foreach ($menuItems as $menu) {
            $menu->children = $this->getMenuTree($menu->id);
        }
    
        return $menuItems;
    }

}
