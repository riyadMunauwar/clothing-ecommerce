<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\Menu;
use App\Models\Category;

class CreateEditMenu extends Component
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
    public $icon;
    public $old_icon;
    public $is_published;
    public $category_id;


    protected $rules = [
        'name' => ['required', 'string'],
        'link' => ['nullable', 'string'],
        'order' => ['nullable', 'integer'],
        'is_published' => ['required', 'boolean'],
        'category_id' => ['nullable', 'integer'],
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
        return view('admin.components.create-edit-menu');
    }


    public function createMenu()
    {
        $this->validate();

        $menu = new Menu();

        $menu->name = $this->name;
        $menu->order = $this->order;
        $menu->link = $this->link;
        $menu->category_id = $this->category_id;
        $menu->is_published = $this->is_published;

        if($menu && $this->icon)
        {
            $menu->addMedia($this->icon)->toMediaCollection('icon');
        }

        if($menu->save())
        {
            $this->reset();
            $this->preparedInitData();
            $this->emit('onMenuCreated');
            $this->success('Created', '');
        }
    }

    public function updateMenu()
    {
        $this->validate();

        $menu = Menu::find($this->menu_id);

        $menu->name = $this->name;
        $menu->order = $this->order;
        $menu->link = $this->link;
        $menu->category_id = $this->category_id;
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
        $this->preparedInitData();
        $this->is_edit_mode_on = false;
    }

    public function enableMenuEditMode($id)
    {

        $menu = Menu::find($id);

        $this->menu_id = $menu->id;
        $this->name = $menu->name;
        $this->order = $menu->order;
        $this->link = $menu->link;
        $this->is_published = $menu->is_published;
        $this->category_id = $menu->category_id;
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
