<?php 

namespace App\Services\Payment;

use App\Services\Payment\PaymentMethodContract;
use App\Services\Payment\AamarpayPaymentMethod;

class PaymentContext 
{

    private PaymentMethodContract $strategy;


    public function __construct(string $paymentMethod)
    {
        $method = match($paymentMethod) {
            'aamarpay' => new AamarpayPaymentMethod(),
            default => throw new \InvalidArgumentException('You must pass a payment method name such as aamarpay or bkash'),
        };

        $this->strategy = $method;
    }


    public function pay(float $amount, array $options)
    {
        return $this->strategy($amount, $options);
    }
}