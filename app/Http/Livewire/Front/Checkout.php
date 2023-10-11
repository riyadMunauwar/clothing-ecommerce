<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Services\Cart\CartService;
use App\Services\Payment\PaymentContext;
use App\Services\Order\OrderService;

class Checkout extends Component
{

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

    public function mount()
    {
        $this->checkIsShippingOptionSelected();
    }

    public function render()
    {
        $this->initData();
        return view('front.components.checkout');
    }


    private function checkIsShippingOptionSelected()
    {
        $isSelect = session()->has('shipping_option') ? session()->get('shipping_option') : false;

        if(!$isSelect){
            return redirect()->route('cart');
        }
    }

    private function createOrder()
    {

        $service = new OrderService();


        $data = [
            'order_no' => $service->generateRandomNumberString(),
            'total_price' => 1000,
            'shipping_price' => 100,
            'admin_notes' => '',
            'customer_notes' => '',
            'user_id' => '',
            'admin_id' => '',
            'address_id' => '',
            'shipping_option' => '',
            'payment_option' => '',
            'order_status' => '',
            'payment_status' => '',
        ];

        return $data;
    }


    public function startPayment()
    {
        $this->validate();
        
        // dd($this->createOrder());

        $payment = new PaymentContext('aamarpay');

        $response = $payment->pay(1000.000, []);


        redirect()->away($response['payment_url']);
    }


    private function initData()
    {
        $this->shippingCost = session()->get('shipping_cost');

        $cart = new CartService();
        
        $this->cartItems = $cart->all();
        $this->subTotal = $cart->subTotal();
        $this->total = $cart->total(discount: 0, shippingCost: $this->shippingCost);
  
    }
}
