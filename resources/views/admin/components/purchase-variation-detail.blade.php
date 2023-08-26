<div>
    @if($is_purchase_variation_modal_show)
        <x-ui.edit-modal class="max-w-2xl">
            <div class="bg-white p-5 md:p-10 rounded-md">

                <div class="flex justify-between items-center">
                    <h1 class="font-bold text-xl mb-4">Variation Attribute</h1>
                    <span wire:click.debounce="cancelPurchaseVariation" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            @foreach($variation->options as $key => $value)
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-2/5">
                                        {{ $key }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 w-5">
                                        :
                                    </th>
                                    <th scope="col" class="px-6 py-3 w-3/5">
                                        {{ $value }}
                                    </th>
                                </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
            </div>
        </x-ui.edit-modal>
        <x-ui.loading-spinner wire:loading.flex wire:target="cancelPurchaseVariation" />
    @endif
</div>