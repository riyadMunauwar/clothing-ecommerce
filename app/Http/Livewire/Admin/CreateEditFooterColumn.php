<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\FooterColumn;
use App\Traits\WithSweetAlert;

class CreateEditFooterColumn extends Component
{
    use WithSweetAlert;

    public $is_edit_mode_on = false;

    public $column_title;
    public $is_published;

    public $footer_column_id;


    public $rules = [
        'column_title' => ['required', 'string'],
        'is_published' => ['required', 'boolean'],
    ];


    protected $listeners = [
        'onFooterColumnEdit' => 'enableEditMode',
    ];

    public function render()
    {
        return view('admin.components.create-edit-footer-column');
    }


    public function createFooterColumn()
    {
        $this->validate();

        $footerColumn = new FooterColumn();

        $footerColumn->column_title = $this->column_title;
        $footerColumn->is_published = $this->is_published;

        if($footerColumn->save())
        {
            $this->reset();
            $this->emit('onFooterColumnCreated');
            return $this->success('Created', '');
        }

        return $this->error('Failed', 'Something went wrong. Try again');
    }

    public function updateFooterColumn()
    {
        $this->validate();

        $footerColumn = FooterColumn::find($this->footer_column_id);

        $footerColumn->column_title = $this->column_title;
        $footerColumn->is_published = $this->is_published;

        if($footerColumn->save())
        {
            $this->reset();
            $this->emit('onFooterColumnUpdated');
            return $this->success('Updated', '');
        }

        return $this->error('Failed', 'Something went wrong. Try again');
        
    }

    public function enableEditMode($id)
    {
        $footerColumn = FooterColumn::find($id);

        $this->footer_column_id = $footerColumn->id;
        $this->column_title = $footerColumn->column_title;
        $this->is_published = $footerColumn->is_published;

        $this->is_edit_mode_on = true;
    }

    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }
}
