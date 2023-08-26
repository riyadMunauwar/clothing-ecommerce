<div class="bg-white rounded-sm p-5">

    <div class="flex justify-between items-center border-b pb-3">
        <h4 class="text-2xl font-bold">Order & Account Information</h4>
        <div>
            <button wire:click.debounce="downloadInvoice" type="button">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                    </svg>
                </span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-2 mt-7">
        <div>
            <h5 class="text-xl font-bold">Order Information</h5>

            <div class="grid grid-cols-3 mt-4">
                <h6 class="grid-cols-1 text-md text-gray-600">Order Date</h6>
                <h6 class="grid-cols-2 text-md text-gray-600">{{ $order->order_date->format('d M Y') ?? $order->created_at->format('d M Y') }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Shipped Date</h6>
                <h6 class="grid-cols-2 text-md text-gray-600">{{ $order->user->email ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Order Status</h6>
                <div class="grid-cols-2">
                    <x-ui.select wire:model.debounce="order.status" id="status" class="block bg-gray-50 h-8 text-sm mt-1 w-full">
                        <option value="">None</option>
                        <option value="canceled">Canceled</option>
                        <option value="completed">Completed</option>
                        <option value="on_hold">On Hold</option>
                        <option value="pending" selected="">Pending</option>
                        <option value="pending_payment">Pending Payment</option>
                        <option value="processing">Processing</option>
                        <option value="refunded">Refunded</option>
                    </x-ui.select>
                </div>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Shipper</h6>
                <h6 class="grid-cols-2 text-md text-gray-600"><span class="bg-indigo-100 text-indigo-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded">{{ $order->shipper_name ?? 'UPS' }}</span></h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Parcel Id</h6>
                <h6 class="grid-cols-2 text-md text-gray-600"><span class="bg-purple-100 text-purple-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded">{{ $order->parcel_id ?? '#646' }}</span></h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Parcel Weight</h6>
                <div class="grid-cols-2">
                    <x-input wire:model.debounce="order.parcel_weight" class="block h-8 mt-1 w-full" type="text" />
                </div>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Parcel Height</h6>
                <div class="grid-cols-2">
                    <x-input wire:model.debounce="order.parcel_height" class="block h-8 mt-1 w-full" type="text" />
                </div>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Parcel Width</h6>
                <div class="grid-cols-2">
                    <x-input wire:model.debounce="order.parcel_height" class="block h-8 mt-1 w-full" type="text" />
                </div>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Parcel Length</h6>
                <div class="grid-cols-2">
                    <x-input wire:model.debounce="order.parcel_height" class="block h-8 mt-1 w-full" type="text" />
                </div>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Parcel Label</h6>
                <div class="grid-cols-2">
                    <a href="{{ $order->label_url }}" class="text-blue-400 underline" target="_blank">Downloand Label</a>
                </div>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Track Url</h6>
                <div class="grid-cols-2">
                    <a href="{{ $order->parcel_url }}" class="text-blue-400 underline" target="_blank">Track Parcel</a>
                </div>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Tracking Number</h6>
                <h6 class="grid-cols-2 text-md text-gray-600"><span class="bg-indigo-100 text-indigo-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded">{{ $order->tracking_number ?? '#12456' }}</span></h6>
            </div>
        </div>

        <div>
            <h5 class="text-xl font-bold">Customer Note</h5>
            <div class="mt-2">
                <x-label  for="customer_note" value="{{ __('Customer Note') }}" />
                <x-ui.textarea wire:model.debounce="order.order_note" id="customer_note" class="block mt-1 w-full" type="text" required />
            </div>

            <h5 class="text-xl font-bold mt-5">Admin Note</h5>

            <div class="mt-2">
                <x-label  for="admin_note" value="{{ __('Admin Note') }}" />
                <x-ui.textarea wire:model.debounce="order.admin_note" id="admin_note" class="block mt-1 w-full" type="text" required />
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
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->name ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Email</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->email ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Phone</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->email ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Street No</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->email ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Street 1</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->email ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Street 2</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->email ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Street 3</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->email ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">City</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->email ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">State</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->email ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Zip Code</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->email ?? '' }}</h6>
            </div>

            <div class="grid grid-cols-3 mt-2">
                <h6 class="grid-cols-1 text-md text-gray-600">Country</h6>
                <h6 class="grid-cols-2 text-md font-semibold text-gray-900">{{ $order->user->email ?? '' }}</h6>
            </div>
        </div>
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
                        <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem->price ?? 0) }}</td>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem->qty ?? 0) }}</td>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem->product->stock_qty ?? 0) }}</td>
                        <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem->qty * $orderItem->price) }}</td>
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
                            <h5 class="text-md mt-5">{{ number_format($order->orderItems->sum('price')) }}</h5>
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
                            <h5 class="text-md mt-2">{{ number_format($order->shipping_cost) }}</h5>
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
                            <h5 class="text-md mt-2">{{ number_format($order->total_vat) }}</h5>
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
                            <h5 class="text-md mt-2">{{ number_format($order->coupon_discount ?? 0) }}</h5>
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
                            <h5 class="text-xl font-bold mt-2">{{ number_format($order->totalPrice()) }}</h5>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>