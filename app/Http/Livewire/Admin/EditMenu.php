<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\Menu;
use App\Models\Category;


class EditMenu extends Component
{


    use WithSweetAlert;
    use WithFileUploads;

    public $is_edit_mode_on = false;

    public $menu_id;

    public $is_use_link = false;
    public $categories = [];


    public $name;
    public $link;
    public $order;
    public $type;
    public $icon;
    public $old_icon;
    public $is_published;
    public $category_id;
    public $parent_id;


    protected $rules = [
        'name' => ['required', 'string'],
        'link' => ['nullable', 'string'],
        'order' => ['nullable', 'integer'],
        'is_published' => ['required', 'boolean'],
        'category_id' => ['nullable', 'integer'],
        'parent_id' => ['nullable', 'integer'],
    ];

    protected $listeners = [
        'onMenuEdit' => 'enableMenuEditMode'
    ];


    public function mount()
    {
        $this->preparedInitData();
    }

    public function render()
    {
        return view('admin.components.edit-menu');
    }


    public function updateMenu()
    {
        $this->validate();

        $menu = Menu::find($this->menu_id);

        if($this->link && $this->is_use_link){
            $this->category_id = null;
        }

        if(!$this->is_use_link && $this->category_id){
            $this->link = null;
        }

        $menu->name = $this->name;
        $menu->order = $this->order;
        $menu->link = $this->link;
        $menu->type = $this->type;
        $menu->category_id = $this->category_id;
        $menu->parent_id = $this->parent_id;
        $menu->is_published = $this->is_published;


        if($menu && $this->icon)
        {
            $menu->addMedia($this->icon)->toMediaCollection('icon');
        }

        if($menu->save())
        {
            $this->reset();
            $this->preparedInitData();
            $this->emit('onMenuUpdated');
            $this->success('Udpated', '');
        }

    }


    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }

    public function enableMenuEditMode($id)
    {

        $this->preparedInitData();

        $menu = Menu::find($id);

        $this->menu_id = $menu->id;
        $this->name = $menu->name;
        $this->order = $menu->order;
        $this->link = $menu->link;
        $this->type = $menu->type;
        $this->is_published = $menu->is_published;
        $this->category_id = $menu->category_id;
        $this->parent_id = $menu->parent_id;
        $this->old_icon = $menu->iconUrl();

        $this->is_edit_mode_on = true;

    }


    public function removeIcon()
    {
        $this->icon->delete();
        $this->icon = null;
    }

    private function preparedInitData()
    {
        $this->categories = Category::all();
    }
}
