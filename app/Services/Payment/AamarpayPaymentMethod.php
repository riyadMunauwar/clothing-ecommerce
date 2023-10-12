<?php 

namespace App\Services\Payment;
use App\Services\Payment\AamarpayPaymentService;

class AamarpayPaymentMethod implements PaymentMethodContract
{
    public function pay(float $amount, array $options)
    {
        $aamarpay = new AamarpayPaymentService();

        return $aamarpay->sendPaymentRequest($options);
    }
}