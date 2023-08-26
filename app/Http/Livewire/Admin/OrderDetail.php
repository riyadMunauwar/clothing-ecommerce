<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Traits\WithSweetalert;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderDetail extends Component
{
    use WithSweetalert;

    public Order $order;

    protected $rules = [
        'order.parcel_weight' => ['numeric', 'required'],
        'order.parcel_height' => ['numeric', 'required'],
        'order.parcel_width' => ['numeric', 'required'],
        'order.parcel_length' => ['numeric', 'required'],
        'order.status' => ['string', 'required'],
    ];

    public function mount($orderId)
    {
        $this->order = Order::with('orderItems.product', 'user')->find($orderId);
    }


    public function render()
    {
        return view('admin.components.order-detail');
    }

    public function updatedOrderStatus()
    {
        dd($this->status);;
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

        try {
            $order = $this->order->toArray();
        
            $pdf = Pdf::loadView('invoices.invoice-template-1', compact('order'));
            // dd($pdf);
            return $pdf->download('billing-invoice');
        }catch(\Exception $e){
            dd($e->getMessage());
        }   

    }
}
