<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache; 

class Header extends Component
{

    protected $menus;

    public function mount()
    {
        $this->menus = $this->getMenus();
        // dd($this->menus);
    }

    public function render()
    {
        return view('front.components.header')->with(['menus' => $this->menus]);
    }


    private function getMenus()
    {
        $cacheKey = config('cache_keys.menu_items_cache_key');

        $menus = Cache::remember( $cacheKey, config('cache.cache_ttl'), function(){
            return $this->getMenuTree();
        });

        return $menus;
    }

 
    private function getMenuTree($parentId = null) {
        
        $menuItems = Menu::with('category')
            ->select('id', 'name', 'link', 'type')
            ->where('parent_id', $parentId)
            ->where('is_published', true)
            ->get();
    
        foreach ($menuItems as $menu) {
            $menu->children = $this->getMenuTree($menu->id);
        }
    
        return $menuItems;
    }
    

}
