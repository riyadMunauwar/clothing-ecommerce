<?php 

namespace App\Services\Payment;
use App\Services\Payment\AamarpayPaymentService;

class AamarpayPaymentMethod implements PaymentMethodContract
{
    public function pay(float $amount, array $options)
    {
        $aamarpay = new AamarpayPaymentService();

        $options = [
            'amount' => $amount,
            'tran_id' => rand(11111111111, 11111111111111111),
            'cus_name' => 'Riyad Munauwar',  
            'cus_email' => 'contact.riyad@gmail.com', 
            'cus_add1' => 'paratungi',  
            'cus_add2' => 'paratungi, muktagacha', 
            'cus_city' => 'muktagacha', 
            'cus_country' => 'Bangladesh',  
            'cus_phone' => '01794263387',
        ];

        return $aamarpay->sendPaymentRequest($options);
    }
}