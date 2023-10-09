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


 
    private function getMenuTree($parentId = null) {
        
        $menuItems = Menu::with('category')
            ->select('id', 'name', 'link')
            ->where('parent_id', $parentId)
            ->where('is_published', true)
            ->get();
    
        foreach ($menuItems as $menu) {
            $menu->children = $this->getMenuTree($menu->id);
        }
    
        return $menuItems;
    }
    

}
