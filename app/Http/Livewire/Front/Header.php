<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Facades\Cache; 

class Header extends Component
{

    protected $menus;

    public function mount()
    {
        $this->menus = $this->getMenus();
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
        
        $menuItems = Menu::select('id', 'name', 'category_id', 'link', 'type')
            ->where('parent_id', $parentId)
            ->where('is_published', true)
            ->orderBy('order')
            ->get();
    
        foreach ($menuItems as $menu) {

            // if($menu->category_id) {
            //     $category = Category::select('slug')->first();
            //     $menu->category_slug = $category->slug;
            // }

            $menu->children = $this->getMenuTree($menu->id);
        }
    
        return $menuItems;
    }
    

}
