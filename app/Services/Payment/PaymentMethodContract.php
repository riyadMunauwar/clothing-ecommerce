<?php 

namespace App\Services\Payment;


interface PaymentMethodContract 
{
    public function pay(double $amount, array $options);
}