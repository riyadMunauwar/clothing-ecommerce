<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\User as Customer;

class CustomerList extends Component
{

    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onCustomerCreated' => '$refresh',
        'onCustomerUpdated' => '$refresh',
        'onCustomerDelete' => 'deleteCustomer',
    ];


    public function render()
    {
        $customers = $this->getcustomers();

        return view('admin.components.customer-list', compact('customers'));
    }


    public function enableCustomerEditMode($id)
    {
        $this->emit('onCustomerEdit', $id);
    }


    public function confirmDeleteCustomer($id)
    {
        return $this->ifConfirmThenDispatch('onCustomerDelete', $id, 'Are you sure ?', 'Customer will delete permanently !');
    }


    public function deleteCustomer($id)
    {
        if(Customer::destroy($id)){
            return $this->success('Success', 'Customer deleted successfully.');
        }

        return $this->error('Failed', 'Failed to delete Customer. try again');
    }


    private function getcustomers()
    {

        $search = trim($this->search);

        $query = Customer::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('name', $search)
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('email', $search);
        });

        return $query->paginate(25);

    }
}
