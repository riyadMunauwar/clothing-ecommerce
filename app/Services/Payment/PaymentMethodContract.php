<?php 

namespace App\Services\Payment;


interface PaymentMethodContract 
{
    public function pay(float $amount, array $options);
}