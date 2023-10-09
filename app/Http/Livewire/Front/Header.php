<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Menu;

class Header extends Component
{

    protected $menus;

    public function mount()
    {
        $this->menus = $this->getMenus();

        dd($this->menus);
    }

    public function render()
    {
        return view('front.components.header');
    }


    public function getMenus()
    {
        return Menu::with([
            'children' => function ($query) {
                $query->where('is_published', true); // Filter children with is_published = true
            },
            'category' => function ($query) {
                $query->where('is_published', true); // Filter related category with is_published = true
            }
        ])
        ->whereNull('parent_id') // Only select parent menu items
        ->where('is_published', true) // Filter parent menu items with is_published = true
        ->get();
    }

}
