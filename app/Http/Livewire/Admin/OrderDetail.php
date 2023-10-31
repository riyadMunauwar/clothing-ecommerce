<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Traits\WithSweetAlert;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderDetail extends Component
{
    use WithSweetalert;

    public Order $order;
    public $orderSubtotalPrice = 0;

    protected $rules = [
        'order.order_status' => ['string', 'required'],
        'order.payment_status' => ['string', 'required'],
        'order.payment_status' => ['string', 'required'],
        'order.admin_notes' => ['string', 'nullable'],
        'order.customer_notes' => ['string', 'nullable'],
    ];

    public function mount($orderId)
    {
        $this->order = Order::with('orderItems.product', 'address', 'user', 'payments')->find($orderId);
        $this->calculateSubtotalPrice();
    }


    public function render()
    {
        return view('admin.components.order-detail');
    }

    public function updated($key, $value)
    {
        dd($key, $value);;
    }

    public function updateOrder()
    {
        return $this->success('Updated', '');
    }

    public function changeStatus()
    {

    }

    public function downloadInvoice()
    {
        return redirect()->route('orders.download', ['orderId' => $this->order->id]);
    }

    public function printInvoice()
    {
        
    }


    private function calculateSubtotalPrice()
    {
        $sum = 0;

        foreach($this->order->orderItems as $item){
            $sum += (float) $item->price * $item->qty;
        }

        $this->orderSubtotalPrice = $sum;
    }
}
