<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\FooterColumn;
use App\Models\FooterColumnAttribute;
use App\Traits\WithSweetAlert;

class FooterColumnList extends Component
{

    use WithSweetAlert;

    protected $listeners = [
        'onFooterColumnCreated' => '$refresh', 
        'onFooterColumnUpdated' => '$refresh', 
        'onFooterColumnItemCreated' => '$refresh', 
        'onFooterColumnItemUpdated' => '$refresh',
        'onFooterColumnDelete' => 'DeleteFooterColumn',
        'onFooterColumnItemDelete' => 'DeleteFooterColumnItem',
    ];
    
    public function render()
    {
        $columns = $this->getFooterColumns();
        return view('admin.components.footer-column-list', compact('columns'));
    }

    public function confirmFooterColumnDelete($id)
    {
        return $this->ifConfirmThenDispatch('onFooterColumnDelete', $id, 'Are you sure ?', 'Footer column  will delete permanently.');
    }

    public function DeleteFooterColumn($id)
    {
        try {

            FooterColumn::destroy($id);
            $this->render();
            return $this->success('Deleted', '');

        }catch(\Exception $e)
        {
            return $this->error('Failed', 'Something went wrong. Try again');
        }
    }

    public function confirmFooterColumnItemDelete($id)
    {
        return $this->ifConfirmThenDispatch('onFooterColumnItemDelete', $id, 'Are you sure ?', 'Footer column item will delete permanently.');
    }

    public function DeleteFooterColumnItem($id)
    {
        try {

            FooterColumnAttribute::destroy($id);
            $this->render();
            return $this->success('Deleted', '');

        }catch(\Exception $e)
        {
            return $this->error('Failed', 'Something went wrong. Try again');
        }
    }


    public function enableFooterColumnEditMode($id)
    {
        return $this->emit('onFooterColumnEdit', $id);
    }


    public function enableFooterColumnItemEditMode($id, $columnId)
    {   
        return $this->emit('onFooterColumnItemEdit' . $columnId, $id);
    }


    private function getFooterColumns()
    {
        return FooterColumn::with('attributes')->get();
    }
}
