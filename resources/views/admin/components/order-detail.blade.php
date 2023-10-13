<div class="bg-white rounded-sm p-5">

    <div class="flex justify-between items-center border-b pb-3">
        <h4 class="text-2xl font-bold">Order & Account Information</h4>
        <div class="flex gap-5">
            <button wire:click.debounce="downloadInvoice" type="button" class="flex gap-1">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </span>

                <span wire:loading wire:target="downloadInvoice">processing...</span>
            </button>

            <button wire:click.debounce="printInvoice" type="button">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                    </svg>
                </span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 mt-7">
        <div class="col-span-3">
            <h5 class="text-xl font-bold">Order Information</h5>


            <div class="grid grid-cols-3 mt-4">
                <h6 class="grid-cols-1 text-md text-gray-600">Subtotal</h6>
                <h6 class="grid-cols-2 text-md text-gray-600">$ {{ $order->total_price - $order->shipping_price }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-4">
                <h6 class="grid-cols-1 text-md text-gray-600">Shipping Cost</h6>
                <h6 class="grid-cols-2 text-md text-gray-600">$ {{ $order->shipping_price ?? 0 }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-4">
                <h6 class="grid-cols-1 text-md text-gray-600">Order Total</h6>
                <h6 class="grid-cols-2 text-md text-gray-600">$ {{ $order->totalPrice() ?? 0 }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Order Status</h6>
                <div class="grid-cols-2">
                    <x-ui.select wire:model.debounce="order.status" id="status" class="block bg-gray-50 mt-1 w-full">
                        <option value="">None</option>
                        <option value="new">New</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="refunded">Refunded</option>
                    </x-ui.select>
                </div>
            </div>

            
            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Payment Status</h6>
                <div class="grid-cols-2">
                    <x-ui.select wire:model.debounce="order.payment_status" id="status" class="block bg-gray-50 mt-1 w-full">
                        <option value="">None</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="partially-paid">Unpaid</option>
                    </x-ui.select>
                </div>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Current Order Status</h6>
                <h6 class="grid-cols-2 text-md text-gray-600"><span class="bg-indigo-100 text-indigo-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded">{{ $order->order_status ?? '' }}</span></h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Current Payment Status</h6>
                <h6 class="grid-cols-2 text-md text-gray-600"><span class="bg-indigo-100 text-indigo-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded">{{ $order->payment_status ?? '' }}</span></h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Shipping Option</h6>
                <h6 class="grid-cols-2 text-md text-gray-600"><span class="bg-indigo-100 text-indigo-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded">{{ $order->shipping_option ?? '' }}</span></h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Payment Option</h6>
                <h6 class="grid-cols-2 text-md text-gray-600"><span class="bg-purple-100 text-purple-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded">{{ $order->payment_option ?? '' }}</span></h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Order No</h6>
                <h6 class="grid-cols-2 text-md text-gray-600"><span class="bg-purple-100 text-purple-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded">#{{ $order->id ?? '' }}</span></h6>
            </div>


            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Order Unique No</h6>
                <h6 class="grid-cols-2 text-md text-gray-600"><span class="bg-purple-100 text-purple-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded">#{{ $order->order_no ?? '' }}</span></h6>
            </div>


        </div>

        <div class="col-span-2">
            <h5 class="text-xl font-bold">Customer Note</h5>
            <div class="mt-2">
                <x-label  for="customer_note" value="{{ __('Customer Note') }}" />
                <x-ui.textarea wire:model.debounce="order.customer_notes" id="customer_note" class="block mt-1 w-full" type="text" required />
            </div>

            <h5 class="text-xl font-bold mt-5">Admin Note</h5>

            <div class="mt-2">
                <x-label  for="admin_note" value="{{ __('Admin Note') }}" />
                <x-ui.textarea wire:model.debounce="order.admin_notes" id="admin_note" class="block mt-1 w-full" type="text" required />
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-button wire:click.debounce="updateOrder" class="ml-4">
            {{ __('Save') }}
        </x-button>
    </div>


    <h4 class="text-2xl font-bold border-b pb-3 mt-10">Address Information</h4>


    <div class="grid grid-cols-2 mt-5">
        <div>
            <h5 class="text-xl font-bold">Account Information</h5>

            <div class="grid grid-cols-3 mt-4">
                <h6 class="grid-cols-1 text-md text-gray-600">Customer Name</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->name ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Customer Email</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->email ?? '' }}</h6>
            </div>
        </div>
        <div>
            <h5 class="text-xl font-bold">Shipping Address</h5>
            <div class="grid grid-cols-3 mt-4">
                <h6 class="grid-cols-1 text-md text-gray-600">Name</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->address->full_name ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Email</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->address->email ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Phone</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->address->phone ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Street 1</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->address->street_1 ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Street 2</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->address->street_2 ?? '' }}</h6>
            </div>


            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">City</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->address->city ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">State</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->address->state ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Zip Code</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->address->zip ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Country</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->address->country ?? ''}}</h6>
            </div>
        </div>
    </div>

    <h4 class="text-2xl font-bold border-b pb-3 mt-10">Payments</h4>

    <div class="overflow-x-auto z-20 mt-3 pb-20">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Id</th>
                    <th scope="col" class="px-4 py-3">Reference</th>
                    <th scope="col" class="px-4 py-3">Provider</th>
                    <th scope="col" class="px-4 py-3">Method</th>
                    <th scope="col" class="px-4 py-3">Currency</th>
                    <th scope="col" class="px-4 py-3">Status</th>
                    <th scope="col" class="px-4 py-3">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->payments ?? [] as $payment)
                    <tr class="border-b dark:border-gray-700">
                        <th scope="row" class="px-4 whaitespace-nowrap w-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $payment->id }}
                        </th>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ $payment->reference '' }}</td>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ $payment->provider }}</td>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ $payment->method }}</td>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ $payment->currency }}</td>
                        <td class="px-4 py-1 whaitespace-nowrap">
                            @if($payment->status === 'failed')
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Failed</span>
                            @elseif($payment->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pending</span>
                            @else 
                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Success</span>
                            @endif
                        </td>

                        <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem->qty * $orderItem->price, 2) }}</td>
                    </tr>
                @endforeach
                    <tr>
                        <th scope="row" class="px-4 whaitespace-nowrap w-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white"></th>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap">
                            <h5 class="text-md mt-5">Total</h5>
                        </td>
                        <td class="px-4 py-1 whaitespace-nowrap">
                            <h5 class="text-md mt-5">$ {{ number_format($order->payments->where('status', 'success')->sum('amount'), 2) }}</h5>
                        </td>
                    </tr>
                    
            </tbody>
        </table>
    </div>

    <h4 class="text-2xl font-bold border-b pb-3 mt-10">Items Orderd</h4>

    <div class="overflow-x-auto z-20 mt-3 pb-20">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Image</th>
                    <th scope="col" class="px-4 py-3">Product</th>
                    <th scope="col" class="px-4 py-3">Unit Price</th>
                    <th scope="col" class="px-4 py-3">Order Qty</th>
                    <th scope="col" class="px-4 py-3">Stock Qty</th>
                    <th scope="col" class="px-4 py-3">Line Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems ?? [] as $orderItem)
                    <tr class="border-b dark:border-gray-700">
                        <th scope="row" class="px-4 whaitespace-nowrap w-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-6 h-6" src="{{ $orderItem->product->thumbnailUrl() }}" alt="">
                        </th>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ $orderItem->product->name ?? '' }}</td>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem->price ?? 0, 2) }}</td>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ $orderItem->qty }}</td>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem->product->stock_qty ?? 0, 2) }}</td>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem->qty * $orderItem->price, 2) }}</td>
                    </tr>
                @endforeach
                    <tr>
                        <th scope="row" class="px-4 whaitespace-nowrap w-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white"></th>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap">
                            <h5 class="text-md mt-5">Sub Total</h5>
                        </td>
                        <td class="px-4 py-1 whaitespace-nowrap">
                            <h5 class="text-md mt-5">$ {{ number_format($orderSubtotalPrice, 2) }}</h5>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="px-4 whaitespace-nowrap w-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white"></th>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap">
                            <h5 class="text-md mt-2">Shipping Charge</h5>
                        </td>
                        <td class="px-4 py-1 whaitespace-nowrap">
                            <h5 class="text-md mt-2">$ {{ number_format($order->shipping_cost, 2) }}</h5>
                        </td>
                    </tr>
                    <tr class="">
                        <th scope="row" class="px-4 whaitespace-nowrap w-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white"></th>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 border-b py-1 whaitespace-nowrap">
                            <h5 class="text-md mt-2">Vat/Tax</h5>
                        </td>
                        <td class="px-4 border-b py-1 whaitespace-nowrap">
                            <h5 class="text-md mt-2">$ {{ number_format($order->total_vat, 2) }}</h5>
                        </td>
                    </tr>
                    <tr class="">
                        <th scope="row" class="px-4 whaitespace-nowrap w-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white"></th>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 border-b py-1 whaitespace-nowrap">
                            <h5 class="text-md mt-2">Coupon Discount</h5>
                        </td>
                        <td class="px-4 border-b py-1 whaitespace-nowrap">
                            <h5 class="text-md mt-2">$ {{ number_format($order->coupon_discount ?? 0, 2) }}</h5>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="px-4 whaitespace-nowrap w-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white"></th>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap"></td>
                        <td class="px-4 py-1 whaitespace-nowrap">
                            <h5 class="text-xl font-bold mt-2">Total</h5>
                        </td>
                        <td class="px-4 py-1 whaitespace-nowrap">
                            <h5 class="text-xl font-bold mt-2">$ {{ number_format($order->totalPrice(), 2) }}</h5>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>