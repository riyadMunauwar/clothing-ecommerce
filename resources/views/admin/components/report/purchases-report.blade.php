<div class="p-5 bg-white rounded-sm">
    <h4 class="text-2xl font-bold dark:text-white">Purchase Report</h4>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mt-5">

        <div class="">
            <x-label for="status" value="{{ __('Suppliers') }}" />
            <x-ui.select wire:model.debounce="supplier_id" id="status" class="block bg-gray-50 mt-1 w-full">
                <option value="">None</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name ?? '' }}</option>
                @endforeach
            </x-ui.select>
        </div>

        <div class="">
            <x-label for="filter_by" value="{{ __('Filter By') }}" />
            <x-ui.select wire:model.debounce="filter_by" id="filter_by" class="block bg-gray-50 mt-1 w-full">
                <option value="">None</option>
                <option value="unpaid">Unpaid</option>
                <option value="paid">Paid</option>
                <option value="partially-paid">Partially Paid</option>
            </x-ui.select>
        </div>

        <div class="col-span-2">
            <form class="flex items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full mt-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.debounce.350ms="search" type="text" id="simple-search" class="w-full h-11 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                </div>
            </form>
        </div>

    </div>

    @if($supplier_id)
        <div class="block mt-5">
            <label for="is_show_supplier_details" class="flex items-center">
                <x-checkbox wire:model.debounce="is_show_supplier_details" id="is_show_supplier_details" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Supplier Details') }}</span>
            </label>
        </div>
    @endif

    @if(!$supplier_id)
        <h4 class="text-2xl font-bold mt-5">All Suppliers</h4>

        <div class="overflow-x-auto z-20 mt-7">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">#</th>
                        <th scope="col" class="px-4 py-3">Supplier Name</th>
                        <th scope="col" class="px-4 py-3">Total Buying Items</th>
                        <th scope="col" class="px-4 py-3">Total Bill</th>
                        <th scope="col" class="px-4 py-3">Total Paid</th>
                        <th scope="col" class="px-4 py-3">Total Due</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allSuppliersPurchases ?? [] as  $singleSupplierPurchase )
                    <tr class="bpurchase-b dark:bpurchase-gray-700">
                        <th scope="row" class="px-4 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->index + 1 }}
                        </th>
                        <td class="px-4 py-1">{{ $singleSupplierPurchase['supplier_name'] }}</td>
                        <td class="px-4 py-1">{{ number_format($singleSupplierPurchase['total_items_quantity']) }}</td>
                        <td class="px-4 py-1">{{ number_format($singleSupplierPurchase['total_bill_amount']) }}</td>
                        <td class="px-4 py-1 text-green-400">{{ number_format($singleSupplierPurchase['total_bill_paid']) }}</td>
                        <td class="px-4 py-1 text-red-400">{{ number_format($singleSupplierPurchase['total_bill_due']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else 

    @if($is_show_supplier_details)
        <div class="pt-32 pb-6">
            <div class="bg-white relative shadow rounded-lg w-5/6 md:w-5/6  lg:w-5/6 xl:w-5/6 mx-auto">
                <div class="flex justify-center">
                        <img src="{{ $selectedSupplier->logoUrl() }}" alt="" class="rounded-full mx-auto absolute -top-20 w-32 h-32 shadow-md border-4 border-white transition duration-200 transform hover:scale-110">
                </div>
                
                <div class="mt-16">
                    <h1 class="font-bold text-center text-3xl text-gray-900">{{ $selectedSupplier->name ?? '' }}</h1>
                    <p class="text-center text-sm text-gray-400 font-medium">Supplier</p>
                    <div class="my-5 px-6">
                        <a href="#" class="text-gray-200 block rounded-lg text-center font-medium leading-6 px-6 py-3 bg-gray-900 hover:bg-black hover:text-white uppercase">Contact Information</a>
                    </div>
                    <div class="overflow-x-auto z-20 mt-7">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3 w-1/3">Name</th>
                                    <th scope="col" class="px-4 py-3">:</th>
                                    <th scope="col" class="px-4 py-3 w-2/3">{{ $selectedSupplier->name ?? '' }}</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-4 py-3 w-1/3">Email</th>
                                    <th scope="col" class="px-4 py-3">:</th>
                                    <th scope="col" class="px-4 py-3 w-2/3">{{ $selectedSupplier->email ?? '' }}</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-4 py-3 w-1/3">Phone</th>
                                    <th scope="col" class="px-4 py-3">:</th>
                                    <th scope="col" class="px-4 py-3 w-2/3">{{ $selectedSupplier->phone ?? '' }}</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-4 py-3 w-1/3">City</th>
                                    <th scope="col" class="px-4 py-3">:</th>
                                    <th scope="col" class="px-4 py-3 w-2/3">{{ $selectedSupplier->city ?? '' }}</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-4 py-3 w-1/3">State</th>
                                    <th scope="col" class="px-4 py-3">:</th>
                                    <th scope="col" class="px-4 py-3 w-2/3">{{ $selectedSupplier->state ?? '' }}</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-4 py-3 w-1/3">Country</th>
                                    <th scope="col" class="px-4 py-3">:</th>
                                    <th scope="col" class="px-4 py-3 w-2/3">{{ $selectedSupplier->country ?? '' }}</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-4 py-3 w-1/3">Address</th>
                                    <th scope="col" class="px-4 py-3">:</th>
                                    <th scope="col" class="px-4 py-3 w-2/3">{{ $selectedSupplier->address ?? '' }}</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-4 py-3 w-1/3">Conact Person</th>
                                    <th scope="col" class="px-4 py-3">:</th>
                                    <th scope="col" class="px-4 py-3 w-2/3">{{ $selectedSupplier->contact_person_name ?? '' }}</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-4 py-3 w-1/3">Contact Person phone</th>
                                    <th scope="col" class="px-4 py-3">:</th>
                                    <th scope="col" class="px-4 py-3 w-2/3">{{ $selectedSupplier->contact_person_phone ?? '' }}</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-4 py-3 w-1/3">Contact Person Email</th>
                                    <th scope="col" class="px-4 py-3">:</th>
                                    <th scope="col" class="px-4 py-3 w-2/3">{{ $selectedSupplier->contact_person_email ?? '' }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
        <div class="overflow-x-auto z-20 mt-7">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">#</th>
                        <th scope="col" class="px-4 py-3">Date</th>
                        <th scope="col" class="px-4 py-3">Product Name</th>
                        <th scope="col" class="px-4 py-3">Variation</th>
                        <th scope="col" class="px-4 py-3">Items Qty</th>
                        <th scope="col" class="px-4 py-3">Unit Price</th>
                        <th scope="col" class="px-4 py-3">Line Total Bill</th>
                        <th scope="col" class="px-4 py-3">Line Total Paid</th>
                        <th scope="col" class="px-4 py-3">Line Total Due</th>
                        <th scope="col" class="px-4 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($singleSupplierPurchases ?? [] as  $singleSupplierPurchase )
                    <tr class="bpurchase-b dark:bpurchase-gray-700">
                        <th scope="row" class="px-4 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->index + 1 }}
                        </th>
                        <td class="px-4 py-1">{{ $singleSupplierPurchase->created_at->format('d M Y') ?? '' }}</td>
                        <td class="px-4 py-1">{{ $singleSupplierPurchase->product_name ?? '' }}</td>
                        <td class="px-4 py-1">
                            @if($singleSupplierPurchase->variation_id)
                                <div class="flex items-center gap-1">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>

                                    <span wire:click.debounce="showPurchaseVariationDetail({{ $singleSupplierPurchase->variation_id }})" class="cursor-pointer text-blue-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </span>
                                </div>
                            @else 
                                No
                            @endif
                        </td>
                        <td class="px-4 py-1">{{ number_format($singleSupplierPurchase->qty ?? 0) }}</td>
                        <td class="px-4 py-1">{{ number_format($singleSupplierPurchase->unit_price ?? 0) }}</td>
                        <td class="px-4 py-1 font-semibold">{{ number_format($singleSupplierPurchase->bill_amount ?? 0) }}</td>
                        <td class="px-4 py-1 text-green-400">{{ number_format($singleSupplierPurchase->paid_amount ?? 0) }}</td>
                        <td class="px-4 py-1 text-red-400">{{ number_format($singleSupplierPurchase->due_amount ?? 0) }}</td>
                        <td class="px-4 py-1 text-blue-400">
                            <button wire:click.debounce="enablePurchaseEditMode({{ $singleSupplierPurchase->id }})" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <nav class="py-2 mt-5" aria-label="Table navigation">
            {{ $singleSupplierPurchases->links() }}
        </nav>
    @endif

    <x-ui.loading-spinner wire:loading.flex wire:target="showPurchaseVariationDetail, search, supplier_id, filter_by, is_show_supplier_details, enablePurchaseEditMode" />
</div>



@push('modals')
    <livewire:admin.update-purchase />
    <livewire:admin.purchase-variation-detail />
@endpush