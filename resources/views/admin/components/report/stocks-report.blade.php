<div class="p-5 bg-white rounded-sm">
    <h4 class="text-2xl font-bold dark:text-white">Stocks Report</h4>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mt-5">
        <div>
            <x-label for="quantity_above" value="{{ __('Quantity Above') }}" />
            <x-input wire:model.debounce="quantity_above" id="quantity_above"  class="bg-gray-50 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="quantity_below" value="{{ __('Quantity Below') }}" />
            <x-input wire:model.debounce="quantity_below" id="quantity_below"  class="block bg-gray-50 mt-1 w-full" type="text" />
        </div>

        <div class="">
            <x-label for="stock_availability" value="{{ __('Stock Availability') }}" />
            <x-ui.select wire:model.debounce="stock_availability" id="stock_availability" class="block bg-gray-50 text-base mt-1 w-full">
                <option value="">None</option>
                <option value="canceled">In Stock</option>
                <option value="completed">Out Of Stock</option>
            </x-ui.select>
        </div>

    </div>


    <div class="overflow-x-auto z-20 mt-7">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">#</th>
                    <th scope="col" class="px-4 py-3">Product Name</th>
                    <th scope="col" class="px-4 py-3">Stock Qty</th>
                    <th scope="col" class="px-4 py-3 text-center">Stock Availability</th>
                    <th scope="col" class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products ?? [] as  $product )
                <tr class="bsale-b dark:bsale-gray-700">
                    <th scope="row" class="px-4 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->index + 1 }}
                    </th>
                    <td class="px-4 py-1">{{ $product->name }}</td>
                    <td class="px-4 py-1">
                        @if($product->variations_count > 0)
                            <div class="flex gap-1 items-center">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">v-{{ $product->variations_count }}</span>
                                <span class="cursor-pointer text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </span>
                            </div>
                        @else 
                            @if($product->stock_qty > 0)
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ number_format($product->stock_qty) }}</span>
                            @else 
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Red</span>
                            @endif
                        @endif
                    </td>
                    <td class="px-4 py-1 text-center">
                        @if($product->variations_count > 0)
                            <p>---</p>
                        @else 
                            @if($product->stock_qty > 0)
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">In Stock</span>
                            @else 
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Out of Stock</span>
                            @endif
                        @endif
                    </td>
                    <td class="px-4 py-1"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <nav class="py-2 mt-5" aria-label="Table navigation">
        {{ $products->links() }}
    </nav>

    <x-ui.loading-spinner wire:loading.flex wire:target="quantity_above, quantity_below, stock_availability" />

</div>