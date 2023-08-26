<section>
    @if($is_variations_show)
        <x-ui.edit-modal class="max-w-7xl">
            <div class="rounded-md p-5 md:p-10 bg-white">
                    <div class="flex justify-between mb-5">
                        <h4 class="text-2xl font-bold dark:text-white">{{ $product_name }}</h4>
                        <button wire:click.debounce="cancelVariationsShowMode" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <h1 class="mb-4">Total variations {{ $variations->count() }}</h1>
                    <div class="">
                        <div class="overflow-x-auto z-20">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Image</th>
                                        <th scope="col" class="px-4 py-3">Attribute</th>
                                        <th scope="col" class="px-4 py-3">Regular Price</th>
                                        <th scope="col" class="px-4 py-3">Sale Price</th>
                                        <th scope="col" class="px-4 py-3">Stock</th>
                                        <th scope="col" class="px-4 py-3">Sku</th>
                                        <th scope="col" class="px-4 py-3">Weight</th>
                                        <th scope="col" class="px-4 py-3">Height</th>
                                        <th scope="col" class="px-4 py-3">Length</th>
                                        <th scope="col" class="px-4 py-3 text-center">Status</th>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($variations ?? [] as $variation)
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-14 h-14 border rounded-full object-cover" src="{{ $variation->imageUrl('small') }}" alt="{{ $variation->name ?? '' }}">
                                        </th>
                                        <td class="px-4 py-1">
                                            @foreach($variation->options as $attribue => $value)
                                                <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-1.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ $value }}</span>
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-1">
                                            {{ $variation->regular_price }}
                                        </td>
                                        <td class="px-4 py-1">
                                            {{ $variation->sale_price }}
                                        </td>
                                        <td class="px-4 py-1">
                                            @if($variation->stock_qty < 10)
                                                <span class="text-red-400">{{ $variation->stock_qty }}</span>
                                            @else 
                                                <span class="text-green-500">{{ $variation->stock_qty }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-1">
                                            {{ $variation->sku }}
                                        </td>
                                        <td class="px-4 py-1">
                                            {{ $variation->weight }}
                                        </td>
                                        <td class="px-4 py-1">
                                            {{ $variation->height }}
                                        </td>
                                        <td class="px-4 py-1">
                                            {{ $variation->length }}
                                        </td>
                                        <td class="px-4 py-1">
                                            @if($variation->is_published)
                                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Published</span>
                                            @else
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Unpublished</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-1">
                                            <div class="flex items-center gap-1 justify-end">
                                                <button wire:click.debounce="enableAddStockModal({{ $product_id }}, {{ $variation->id }})" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                    </svg>
                                                </button>
                                                <button wire:click.debounce="enableVariationEditMode({{ $variation->id }})" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                </button>
                                                <button wire:click.debounce="confirmDeleteVariation({{ $variation->id }})" class="ml-1 text-red-400" type="button">
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
                    </div>
                </div>
            </div>
            <x-ui.loading-spinner wire:loading.flex wire:target="enableAddStockModal, deleteVariation, cancelVariationsShowMode, enableVariationEditMode, confirmDeleteVariation" />
        </x-ui.edit-modal>
    @endif
</section>


@push('modals')
    <livewire:admin.edit-variation />
@endpush