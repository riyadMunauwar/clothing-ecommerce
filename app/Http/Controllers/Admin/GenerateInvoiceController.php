<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class GenerateInvoiceController extends Controller
{
    /**
     * Download Invoice controller
     */

     public function downloadInvoice(Request $request)
     {
 
         $orderId = $request->order;
 
         if(!$orderId) return abort(403);
 
 
         $order = Order::with('orderItems.product', 'address', 'user')->find($orderId);
 
    
         $client = new Party([
             'name'          => config('setting.company_name'),
             'phone'         => config('setting.phone'),
             'custom_fields' => [
                 'street'        => config('setting.street_1'),
                 'zip'        => config('setting.zip'),
                 'city'        => config('setting.city'),
                 'state'        => config('setting.state'),
                 'country'        => config('setting.country'),
                 'email'        => config('setting.email'),
             ],
         ]);
 
         $customer = new Party([
             'name'          => $order->address->first_name . ' ' . $order->address->last_name,
             'address'       => $order->address->street_1 . ", " . "zipcode:" . $order->address->zip . ", " . $order->address->city . ", " . $order->address->state . ", " . $order->address->country,
             // 'code'          => '',
             'custom_fields' => [
                 'phone' => $order->address->phone,
                 'email' => $order->address->email,
                 'order number' => '#-' . $order->id,
             ],
         ]);
 
         $order_items = [];
 
         foreach($order->orderItems as $singleItem){
             array_push($order_items, (new InvoiceItem())->title($singleItem->product->name)->pricePerUnit($singleItem->price)->quantity($singleItem->qty));
         }
 
         array_push($order_items, (new InvoiceItem())->title('Shipping Cost')->pricePerUnit($order->shipping_cost));
 
 
         $notes = [
             'your multiline',
             'additional notes',
             'in regards of delivery or something else',
         ];
 
         $notes = implode("<br>", $notes);
 
         $invoice = Invoice::make(config('setting.company_name'))
             ->series('BIG')
             // ability to include translated invoice status
             // in case it was paid
             ->status($order->payment_status)
             ->sequence($order->id)
             ->serialNumberFormat('{SEQUENCE}/{SERIES}')
             ->seller($client)
             ->buyer($customer)
             ->date($order->created_at)
             ->dateFormat('d M Y')
             ->payUntilDays(14)
             ->currencySymbol('$')
             ->currencyCode('USD')
             ->currencyFormat('{SYMBOL}{VALUE}')
             ->currencyThousandsSeparator('.')
             ->currencyDecimalPoint('.')
             ->filename($client->name . ' ' . $customer->name)
             ->addItems($order_items)
             ->notes($notes)
             // ->logo('https://hpanel-main.hostinger.com/assets/img/hostinger.ad61771c.svg')
 
             ->save('public');
 
         $link = $invoice->url();
         // Then send email to party with link
 
         // And return invoice itself to browser or have a different view
         return $invoice->stream();
     }
}
