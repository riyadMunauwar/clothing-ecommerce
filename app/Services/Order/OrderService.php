<?php 

namespace App\Services\Order;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Services\Cart\CartService;
use Illuminate\Support\Str;

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
            $payment->status = 'pending';
            $payment->order_id = $order->id;

            $payment->save();

            return $payment;

        });
    }

    public function createOrderWithoutPayment($amount, $orderData)
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

            return $order;

        });
    }




    public function generateRandomNumberString($minLength = 6, $maxLength = 32)
    {
        // Ensure that $minLength and $maxLength are within bounds
        $minLength = max(1, $minLength);
        $maxLength = max($minLength, min(32, $maxLength));
    
        // Generate a random length between $minLength and $maxLength
        $length = rand($minLength, $maxLength);
    
        // Generate a random number string with the specified length
        $randomNumberString = Str::random($length);
    
        return $randomNumberString;
    }
}