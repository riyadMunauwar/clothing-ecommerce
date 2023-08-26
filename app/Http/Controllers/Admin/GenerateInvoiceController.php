<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;

class GenerateInvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $order = Order::with('orderItems.product', 'user')->find($request->order)->toArray();

            $pdf = Pdf::loadView('invoices.invoice-template-3', compact('order'));
            // dd($pdf);
            return $pdf->stream('billing-invoice.pdf');
        }catch(\Exception $e){
            dd($e->getMessage());
        }  
    }
}
