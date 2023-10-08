<?php 

namespace App\Services\Order;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderService {


    public function createOrder($orderData)
    {
        return DB::transaction(function()use($orderData){

            $order = Order::create($orderData);


            
        });
    }
}