<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\Supplier;

class EditSupplier extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    public $is_edit_mode_on = false;

    public $supplier;

    public $old_logo;
    public $new_logo;

    protected $rules = [
        'supplier.name' => ['required', 'string'],
        'supplier.email' => ['nullable', 'string', 'email'],
        'supplier.phone' => ['nullable', 'string'],
        'supplier.city' => ['nullable', 'string'],
        'supplier.state' => ['nullable', 'string'],
        'supplier.country' => ['nullable', 'string'],
        'supplier.address' => ['nullable', 'string'],
        'supplier.contact_person_name' => ['nullable', 'string'],
        'supplier.contact_person_email' => ['nullable', 'string'],
        'supplier.contact_person_phone' => ['nullable', 'string'],
    ];


    protected $listeners = [
        'onSupplierEdit' => 'enableSupplierEditMode',
    ];

    public function render()
    {
        return view('admin.components.edit-supplier');
    }

    public function updateSupplier()
    {

        $this->validate();

        if($this->new_logo){
            $this->supplier->addMedia($this->new_logo)->toMediaCollection('logo');
        }

        if($this->supplier->save()){

            $this->reset();

            $this->is_edit_mode_on = false;

            $this->emit('onSupplierUpdated');

            return $this->success('Updated', 'Supplier updated successfully');
        }
        
        return $this->error('Failed', 'Something went wrong. Try again !');

    }


    public function enableSupplierEditMode($id)
    {

        $this->supplier = Supplier::find($id);

        $this->old_logo = $this->supplier->logoUrl('small');

        $this->is_edit_mode_on = true;

    }


    public function removeLogo()
    {
        $this->new_logo->delete();
        $this->new_logo = null;
    }


    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }

}
