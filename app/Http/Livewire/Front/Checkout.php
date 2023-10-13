<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Services\Cart\CartService;
use App\Traits\WithSweetAlert;
use App\Services\Payment\PaymentContext;
use App\Services\Order\OrderService;
use App\Models\Address;

class Checkout extends Component
{
    use WithSweetAlert;

    public $payment_method_option;
    public $terms_and_condition;
    public $cartItems = [];
    public $subTotal = 0;
    public $total = 0;
    public $shippingCost = 0;



    public $first_name;
    public $last_name;
    public $email;
    public $mobile_no;
    public $city;
    public $state;
    public $country;
    public $zip;
    public $street_address;
    public $order_notes;


    protected $rules = [
        'first_name' => ['required', 'string', 'max:125'],
        'last_name' => ['required', 'string', 'max:125'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'mobile_no' => ['required', 'string', 'max:255'],
        'city' => ['required', 'string', 'max:255'],
        'state' => ['required', 'string', 'max:255'],
        'zip' => ['required', 'string', 'max:255'],
        'street_address' => ['required', 'string', 'max:255'],
        'order_notes' => ['nullable', 'string', 'max:5000'],
        'payment_method_option' => ['required'],
        'terms_and_condition' => ['required'],
    ];


    public function render()
    {
        $this->initData();
        return view('front.components.checkout');
    }



    private function createAddress()
    {
        $address = new Address();

        $address->name = $this->first_name . ' ' . $this->last_name;
        $address->email = $this->email;
        $address->mobile_no = $this->mobile_no;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip = $this->zip;
        $address->street = $this->street_address;
        $address->user_id = auth()->id();

        $address->save();

        return $address->id;
    }

    private function createOrder($type)
    {

        $service = new OrderService();

        $addressId = $this->createAddress();

        $order_data = [
            'order_no' => $service->getRandomStr(),
            'total_price' => $this->total,
            'shipping_price' => $this->shippingCost,
            'admin_notes' => null,
            'customer_notes' => $this->order_notes,
            'user_id' => auth()->id(),
            'admin_id' => null,
            'address_id' => $addressId,
            'shipping_option' => session()->get('shipping_option'),
            'payment_option' => $this->payment_method_option,
            'order_status' => 'new',
            'payment_status' => 'unpaid',
        ];

        if($type === 'cash-on-delivery'){
            return $service->createOrderWithoutPayment($this->total, $order_data);
        }

        return $service->createOrderWithPayment($this->total, $order_data);
    }


    public function startPayment()
    {
        $this->validate();
        
        match($this->payment_method_option){

            'cash-on-delivery' => $this->handleCashOnDeliveryOrder(),

            'delivery-charge-only' => $this->handleAamarPayPaymentOrder(),

            'aamarpay' => $this->handleAamarPayPaymentOrder(),

        };

    }


    private function handleCashOnDeliveryOrder()
    {
        try {

            $order = $this->createOrder('cash-on-delivery');

            return redirect()->route('register', ['redirect' => 'checkout'])->with('message', "Thank you for choosing us for your recent purchase. Your order #{$order->order_no} has been successfully completed, and we are thrilled to have you as our valued customer.");


        }catch(\Exception $e){

            return $this->error('Failed to create order');

        }
        
    }


    private function handleAamarPayPaymentOrder()
    {

        try {

            $aamarpay = new PaymentContext('aamarpay');

            $payment = $this->createOrder('aamarpay');
    
            $options = [
                'tran_id' => $payment->id,
                'cus_name' => $this->first_name . ' ' . $this->last_name,  
                'cus_email' => $this->email, 
                'cus_add1' => "$this->street_address, $this->zip, $this->city, $this->state",  
                'cus_add2' => $this->street_address, 
                'cus_city' => $this->city, 
                'cus_phone' => $this->mobile_no,
            ];
    
            $response = $aamarpay->pay(amount: $this->total, options: $options);

            $this->clearCartAndSession();

            redirect()->away($response['payment_url']);

        }catch(\Exception $e){

            return $this->error('Failed to create order');
            
        }

    }


    private function initData()
    {
        $this->shippingCost = session()->get('shipping_cost');

        $cart = new CartService();
        
        $this->cartItems = $cart->all();
        $this->subTotal = $cart->subTotal();
        $this->total = $cart->total(discount: 0, shippingCost: $this->shippingCost);
  
        if(auth()->check()){

            $full_name = $this->splitFullName(auth()->user()->name);

            $this->first_name = $full_name['first_name'];

            $this->last_name = $full_name['last_name'];
    
            $this->email = auth()->user()->email;

        }
 
    }


    private function clearCartAndSession()
    {
        $cart = new CartService();

        $cart->removeAll();

        session()->forget('shipping_cost');
        session()->forget('shipping_option');

    }

    function splitFullName($fullName) {

        $names = explode(" ", $fullName);

        $firstName = $names[0];

        $lastName = (count($names) > 1) ? end($names) : '';
        
        return array('first_name' => $firstName, 'last_name' => $lastName);

    }


}
