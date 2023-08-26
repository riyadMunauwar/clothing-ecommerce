<section class="bg-white mx-auto max-w-screen-xl rounded-md p-5">
    <h1>Order list</h1>
    <div class="">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative z-20 overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/3">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full mt-5">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.debounce.350ms="search" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 h-8 text-gray-900 text-sm rounded-md focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-2/3">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="">
                            <x-label for="status" value="{{ __('Status') }}" />
                            <x-ui.select wire:model.debounce="status" id="status" class="block bg-gray-50 h-8 text-sm mt-1 w-full">
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

                        <div>
                            <x-label for="from_date" value="{{ __('From') }}" />
                            <x-input wire:model.debounce="from_date" id="from_date"  class="h-8 bg-gray-50 mt-1 w-full" type="date" />
                        </div>

                        <div>
                            <x-label for="to_date" value="{{ __('To') }}" />
                            <x-input wire:model.debounce="to_date" id="to_date"  class="block bg-gray-50 h-8 mt-1 w-full" type="date" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto z-20 mt-7">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Order Id</th>
                            <th scope="col" class="px-4 py-3">Customer Name</th>
                            <th scope="col" class="px-4 py-3">Customer Email</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Total</th>
                            <th scope="col" class="px-4 py-3">Items</th>
                            <th scope="col" class="px-4 py-3 text-center">Created</th>
                            <th scope="col" class="px-4 py-3 text-center">Date</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders ?? [] as $order)
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row" class="px-4 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                               {{ $order->id ?? '' }}
                            </th>
                            <td class="px-4 py-1">{{ $order->user->name ?? '' }}</td>
                            <td class="px-4 py-1">{{ $order->user->email ?? '' }}</td>
                            <td class="px-4 py-1">
                                @if($order->status ?? '' === 'Canceled' || $order->status ?? '' === 'Refunded')
                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ $order->status ?? '' }}</span>
                                @elseif($order->status ?? '' === 'Payment Pending' || $order->status ?? '' === 'Pending')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $order->status ?? '' }}</span>
                                @else 
                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">{{ $order->status ?? 'Paid' }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-1">{{ $order->total_product_price ?? '' }}</td>
                            <td class="px-4 py-1">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $order->order_items_count ?? '' }}</span>
                            </td>
                            <td class="px-4 py-1">{{ $order->order_date->diffForHumans() }}</td>
                            <td class="px-4 py-1">{{ $order->order_date->format('d M y') }}</td>
                            <td class="px-4 py-1">
                                <div class="flex items-center gap-1 justify-end">
                                    <a href="{{ route('orders.show', ['order' => $order->id]) }}">
                                        <span class="text-blue-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <button wire:click.debounce="enableProductEditMode({{ $order->id }})" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    <button wire:click.debounce="confirmDeleteOrder({{ $order->id }})" class="text-red-400" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav class="py-2 mt-5" aria-label="Table navigation">
                {{ $orders->links() }}
            </nav>
        </div>
    </div>
    <x-ui.loading-spinner wire:loading.flex wire:target="search, status, to_date, enableAddStockModal, confirmDeleteProduct, deleteProduct, enableProductEditMode, showVariationList" />
</section>


@push('modals')
    <livewire:admin.edit-product />
    <livewire:admin.variation-list />
    <livewire:admin.add-stock />
@endpush