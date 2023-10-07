<?php 

namespace App\Services\Payment;

use Illuminate\Support\Facades\Http;


class AamarpayPaymentService
{
    
    public function sendPaymentRequest($paramFields = [])
    {
        $finalFields = $this->getFinalFields($paramFields);

        $response = $this->httpPaymentRequestWith($finalFields);

        if($response->successful())
        {
            return $response->json();
        }
        else 
        {
            return false;
        }
    }


    private function httpPaymentRequestWith($data)
    {
        return Http::accept('application/json')->post(config('aamarpay.payment_endpoint'), $data);
    }


    private function getFinalFields($paramFields)
    {
        $defaultFields = [
            'store_id' => config('aamarpay.store_id'),
            'tran_id' => '',
            'signature_key' => config('aamarpay.signature_key'),
            'success_url' => route('aamarpay.success'),
            'fail_url' => route('aamarpay.failed'), 
            'cancel_url' => route('aamarpay.cancel'),
            'amount' => '', 
            'currency' => 'BDT', 
            'desc' => 'Product payment', 
            'cus_name' => '',  
            'cus_email' => '', 
            'cus_add1' => '',  
            'cus_add2' => '', 
            'cus_city' => '', 
            'cus_country' => 'Bangladesh',  
            'cus_phone' => '',
            'type' => 'json',        
        ];

        return $finalFields = array_merge($defaultFields, $paramFields);
    }


    private function validateMustHaveKeyAndValue($provideArray)
    {
        $mustHaveKeys = [
            'store_id',
            'tran_id',
            'signature_key',
            'success_url',
            'fail_url',
            'cancel_url',
            'amount',
            'currency',
            'desc',
            'cus_name',
            'cus_email',
            'cus_add1',
            'cus_add2',
            'cus_city',
            'cus_state',
            'cus_postcode',
            'cus_country',
            'cus_phone',
        ];

        foreach($mustHaveKeys as $key)
        {
            if(!array_key_exists($key, $provideArray)) return false;
        }
        
    }
}