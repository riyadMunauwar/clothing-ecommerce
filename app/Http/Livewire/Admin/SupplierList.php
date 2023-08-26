<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Supplier;

class SupplierList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onSuppplierCreated' => '$refresh',
        'onSupplierUpdated' => '$refresh',
        'onSupplierDelete' => 'deleteSupplier',
    ];


    public function render()
    {
        $suppliers = $this->getSuppliers();

        return view('admin.components.supplier-list', compact('suppliers'));
    }


    public function enableSupplierEditMode($id)
    {
        $this->emit('onSupplierEdit', $id);
    }


    public function confirmDeleteSupplier($id)
    {
        return $this->ifConfirmThenDispatch('onSupplierDelete', $id, 'Are you sure ?', 'Supplier will delete permanently !');
    }


    public function deleteSupplier($id)
    {
        try {
            Supplier::destroy($id);
            return $this->success('Success', 'Supplier deleted successfully.');
        }catch(\Exception $e)
        {
            return $this->error('Failed', 'Failed to delete Supplier. try again');
        }

    }


    private function getSuppliers()
    {

        $search = $this->search;

        $query = Supplier::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%');
        });

        return $query->paginate(25);

    }

}
