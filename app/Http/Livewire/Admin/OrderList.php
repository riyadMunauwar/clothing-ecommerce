<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Order;

class OrderList extends Component
{

    use WithPagination;
    use WithSweetAlert;

    public $search;
    public $from_date;
    public $to_date;
    public $status;

    protected $listeners = [
        'onOrderCreated' => '$refresh',
        'onOrderUpdated' => '$refresh',
        'onVariationDeleted' => '$refresh',
        'onOrderDelete' => 'deleteOrder',
    ];


    public function render()
    {
        $orders = $this->getOrders();

        return view('admin.components.order-list', compact('orders'));
    }

    public function enableOrderEditMode($id)
    {
        $this->emit('onOrderEdit', $id);
    }


    public function showVariationList($id)
    {
        $this->emit('onVariatioShow', $id);
    }


    public function enableAddStockModal($id)
    {
        $this->emit('onAddStockModalShow', $id);
    }


    public function confirmDeleteOrder($id)
    {
        return $this->ifConfirmThenDispatch('onOrderDelete', $id, 'Are you sure ?', 'Order will delete permanently !');
    }


    public function deleteOrder($id)
    {
        try {

            $Order = Order::find($id);

            foreach($Order->orderItems as $orderItem)
            {
                $orderItem->delete();
            }

            if($Order->delete()){
                return $this->success('Success', 'Order deleted successfully.');
            }

        }catch(\Exception $e)
        {
            return $this->error('Failed', $e->getMessage());
        }

    }


    private function getOrders()
    {

        $search = $this->search;
        $status = $this->status;
        $from_date = $this->from_date;
        $to_date = $this->to_date;

        $query = Order::query();

        $query->when($this->search, function($query) use($search){
            $query->withWhereHas('user', function($query) use($search){
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('name', $search)
                      ->orWhere('email', 'like', '%' . $search . '%')
                      ->orWhere('email', $search);
            });
        });

        $query->when($this->status, function($query) use($status){

        });

        $query->when($this->from_date && $this->to_date, function($query) use($from_date, $to_date){
            
            $query->whereBetween('order_date', [$from_date, $to_date]);
        });

        return $query->with('orderItems', 'user')->withCount('orderItems')->latest()->paginate(50);

    }
}
