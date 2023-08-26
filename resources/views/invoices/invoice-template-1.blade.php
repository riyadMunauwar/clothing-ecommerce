<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="bg-white rounded-sm p-5">
            <div class="flex justify-between items-center border-b pb-3">
                <h4 class="text-2xl font-bold">Order & Account Information</h4>
            </div>

            <h4 class="text-2xl font-bold border-b pb-3 mt-10">Address Information</h4>

            <div class="grid grid-cols-2 mt-5">
                <div>
                    <h5 class="text-xl font-bold">Account Information</h5>

                </div>
                <div>
                    <h5 class="text-xl font-bold">Shipping Address</h5>

                </div>
            </div>

            <h4 class="text-2xl font-bold border-b pb-3 mt-10">Items Orderd</h4>

            <div class="overflow-x-auto z-20 mt-3 pb-20">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Product</th>
                            <th scope="col" class="px-4 py-3">Unit Price</th>
                            <th scope="col" class="px-4 py-3">Order Qty</th>
                            <th scope="col" class="px-4 py-3">Stock Qty</th>
                            <th scope="col" class="px-4 py-3">Line Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order['order_items'] ?? [] as $orderItem)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-1 whaitespace-nowrap">{{ $orderItem['product']['name'] ?? '' }}</td>
                                <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem['price'] ?? 0) }}</td>
                                <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem['qty'] ?? 0) }}</td>
                                <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem['product']['stock_qty'] ?? 0) }}</td>
                                <td class="px-4 py-1 whaitespace-nowrap">{{ number_format($orderItem['qty'] * $orderItem['price']) }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 py-1 whaitespace-nowrap">
                                    <h5 class="text-md mt-5">Sub Total</h5>
                                </td>
                                <td class="px-4 py-1 whaitespace-nowrap">
                                    <h5 class="text-md mt-5">{{ number_format($order['total_product_price']) }}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 py-1 whaitespace-nowrap">
                                    <h5 class="text-md mt-2">Shipping Charge</h5>
                                </td>
                                <td class="px-4 py-1 whaitespace-nowrap">
                                    <h5 class="text-md mt-2">{{ number_format($order['shipping_cost']) }}</h5>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 border-b py-1 whaitespace-nowrap">
                                    <h5 class="text-md mt-2">Vat/Tax</h5>
                                </td>
                                <td class="px-4 border-b py-1 whaitespace-nowrap">
                                    <h5 class="text-md mt-2">{{ number_format($order['total_vat']) }}</h5>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 py-1 whaitespace-nowrap"></td>
                                <td class="px-4 border-b py-1 whaitespace-nowrap">
                                    <h5 class="text-md mt-2">Coupon Discount</h5>
                                </td>
                                <td class="px-4 border-b py-1 whaitespace-nowrap">
                                    <h5 class="text-md mt-2">{{ number_format($order['coupon_discount'] ?? 0) }}</h5>
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
                                    <h5 class="text-xl font-bold mt-2">{{ number_format(1000) }}</h5>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
