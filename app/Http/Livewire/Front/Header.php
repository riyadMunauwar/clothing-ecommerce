<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Menu;

class Header extends Component
{

    protected $menus;

    public function mount()
    {
        $this->menus = $this->getMenuTree();

        dd($this->menus);
    }

    public function render()
    {
        return view('front.components.header');
    }


 
    function getMenuTree($parentId = null) {
        $menuItems = Menu::with('category')
            ->where('parent_id', $parentId)
            ->where('is_published', true)
            ->get();
    
        foreach ($menuItems as $menu) {
            $menu->children = getMenuTree($menu->id);
        }
    
        return $menuItems;
    }
    

}
