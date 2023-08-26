<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\FooterColumnAttribute;
use App\Traits\WithSweetAlertToast;
use App\Traits\WithSweetAlert;


class AddEditFooterColumnItem extends Component
{
    use WithSweetAlert;
    use WithSweetAlertToast;

    public $columnId;

    public $is_edit_mode_on = false;
    public $is_add_mode_on = false;

    public $column_item_id;

    public $name;
    public $link;
    public $is_published;

    protected $rules = [
        'name' => ['required', 'string'],
        'link' => ['nullable', 'string'],
        'is_published' => ['required', 'boolean'],
    ];

    protected function getListeners()
    {
        return ['onFooterColumnItemEdit' . $this->columnId => 'enableColumnItemEditMode'];
    }

    public function mount($columnId)
    {
        $this->columnId = $columnId;
    }

    public function render()
    {
        return view('admin.components.add-edit-footer-column-item');
    }

    public function createFooterColumnItem()
    {
        $this->validate();

        $columnItem = new FooterColumnAttribute();

        $columnItem->name = $this->name;
        $columnItem->link = $this->link;
        $columnItem->is_published = $this->is_published;
        $columnItem->footer_column_id = $this->columnId;

        if($columnItem->save())
        {
            $this->resetColumnField();
            $this->emit('onFooterColumnItemCreated');
            return $this->success('Created', '');
        }

        return $this->error('Failed', 'Something went wrong. Try again');

    }

    public function updateFooterColumnItem()
    {
        $this->validate();

        $columnItem = FooterColumnAttribute::find($this->column_item_id);

        $columnItem->name = $this->name;
        $columnItem->link = $this->link;
        $columnItem->is_published = $this->is_published;

        if($columnItem->save())
        {
            $this->emit('onFooterColumnItemUpdated');
            return $this->success('Updated', '');
        }

        return $this->error('Failed', 'Something went wrong. Try again'); 
    }


    public function enableAddFooterColumnItemMood()
    {
        $this->is_add_mode_on = true;
    }

    public function enableColumnItemEditMode($id)
    {
        $columnItem = FooterColumnAttribute::find($id);

        $this->column_item_id = $columnItem->id;
        $this->name = $columnItem->name;
        $this->link = $columnItem->link;
        $this->is_published = $columnItem->is_published;

        $this->is_edit_mode_on = true;
    }

    public function cancelAddColumnEditMode()
    {

    }


    public function cancelAddColumnItem()
    {
        $this->resetColumnField();
        $this->is_add_mode_on = false;
    }


    private function resetColumnField()
    {
        $this->name = '';
        $this->link = '';
        $this->is_published = false;
    }

}
