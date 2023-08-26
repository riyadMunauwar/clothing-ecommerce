<div class="p-5 bg-white rounded-sm">
    <h4 class="text-2xl font-bold dark:text-white">Sales Report</h4>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mt-5">
        <div>
            <x-label for="from_date" value="{{ __('From') }}" />
            <x-input wire:model.debounce="from_date" id="from_date"  class="h-8 bg-gray-50 mt-1 w-full" type="date" />
        </div>

        <div>
            <x-label for="to_date" value="{{ __('To') }}" />
            <x-input wire:model.debounce="to_date" id="to_date"  class="block bg-gray-50 h-8 mt-1 w-full" type="date" />
        </div>

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

        <div class="">
            <x-label for="status" value="{{ __('Filter By') }}" />
            <x-ui.select wire:model.debounce="last_day" id="status" class="block bg-gray-50 h-8 text-sm mt-1 w-full">
                <option value="">None</option>
                <option value="1">Today</option>
                <option value="3">Last 3 Days</option>
                <option value="5">Last 5 Days</option>
                <option value="7">Last 7 Days</option>
                <option value="15">Last 15 Days</option>
                <option value="30">Last 30 Days</option>
                <option value="90">Last 3 Month</option>
                <option value="180">Last 6 Month</option>
                <option value="270">Last 9 Month</option>
                <option value="360">Last 12 Month</option>
                <option value="720">Last 2 Year</option>
                <option value="1080">Last 3 Year</option>
                <option value="1440">Last 4 Year</option>
                <option value="1800">Last 5 Year</option>
            </x-ui.select>
        </div>
    </div>


    <h4 class="text-2xl font-bold mt-5">Total Sales : {{ number_format($sales->sum('total_sale')) }}</h4>


    <div class="overflow-x-auto z-20 mt-7">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">#</th>
                    <th scope="col" class="px-4 py-3">Date</th>
                    <th scope="col" class="px-4 py-3">Day</th>
                    <th scope="col" class="px-4 py-3">Month</th>
                    <th scope="col" class="px-4 py-3">Year</th>
                    <th scope="col" class="px-4 py-3">Total Order</th>
                    <th scope="col" class="px-4 py-3">Total Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales ?? [] as  $sale )
                <tr class="bsale-b dark:bsale-gray-700">
                    <th scope="row" class="px-4 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->index + 1 }}
                    </th>
                    <td class="px-4 py-1">{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                    <td class="px-4 py-1">{{ \Carbon\Carbon::parse($sale->date)->format('D') }}</td>
                    <td class="px-4 py-1">{{ \Carbon\Carbon::parse($sale->date)->format('M') }}</td>
                    <td class="px-4 py-1">{{ \Carbon\Carbon::parse($sale->date)->format('Y') }}</td>
                    <td class="px-4 py-1">{{ $sale->total_order ?? 0 }}</td>
                    <td class="px-4 py-1">{{ number_format($sale->total_sale ?? 0) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <nav class="py-2 mt-5" aria-label="Table navigation">
        {{ $sales->links() }}
    </nav>

    <x-ui.loading-spinner wire:loading.flex wire:target="to_date, status, last_day" />

</div>