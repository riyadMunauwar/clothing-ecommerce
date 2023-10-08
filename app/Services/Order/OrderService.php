<?php 

namespace App\Services\Order;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Services\Cart\CartService;

class OrderService {


    public function createOrderWithPayment($amount, $orderData)
    {
        $cart = new CartService();

        $orderItems = $cart->all();

        return DB::transaction(function()use($amount, $orderData, $orderItems){

            $order = Order::create($orderData);

            foreach($orderItems as $item){

                $orderItem = new OrderItem();

                $orderItem->price = $item->price;
                $orderItem->qty = $item->qty;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;

                $orderItem->save();
            }

            $payment = new Payment();

            $payment->amount = $amount;
            $payment->order_id = $order->id;


            $payment->save();

            return $payment;

        });
    }
}