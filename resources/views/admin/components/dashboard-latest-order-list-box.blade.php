<div class="bg-white p-5">
    <h6 class="text-lg font-bold dark:text-white">Latest Order</h6>
    <div class="overflow-x-auto z-20 mt-3">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Order Id</th>
                    <th scope="col" class="px-4 py-3">Total</th>
                    <th scope="col" class="px-4 py-3">Status</th>
                    <th scope="col" class="px-4 py-3">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders ?? [] as $order)
                    <tr class="border-b dark:border-gray-700">
                        <th scope="row" class="px-4 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->id ?? '' }}
                        </th>
                        <td class="px-4 py-1">{{ number_format($order->total_product_price ?? 0) }}</td>
                        <td class="px-4 py-1">
                            @if($order->status ?? '' === 'Canceled' || $order->status ?? '' === 'Refunded')
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ $order->status ?? '' }}</span>
                            @elseif($order->status ?? '' === 'Payment Pending' || $order->status ?? '' === 'Pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $order->status ?? '' }}</span>
                            @else 
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">{{ $order->status ?? 'Paid' }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-1"><a href="{{ route('orders.show', ['order' => $order->id]) }}" class="underline text-blue-400">view</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>