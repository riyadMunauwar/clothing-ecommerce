<div>
    @if($is_edit_mode_on)
    <x-ui.edit-modal class="max-w-3xl">
        <div class="p-5 md:pl-10 md:pb-10 md:pr-10 bg-white rounded-md">

            <div class="flex justify-end mb-2">
                <span wire:click.debounce="cancelEditMode" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>

            <x-validation-errors class="mb-4" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <x-label  for="" value="{{ __('Sale Price') }}" />
                    <x-input wire:model.debounce="variation.sale_price" id="" class="block mt-1 h-8 w-full" type="number" />
                </div>

                <div>
                    <x-label  for="reg_price" value="{{ __('Regular Price') }}" />
                    <x-input wire:model.debounce="variation.regular_price" id="reg_price" class="block mt-1 h-8 w-full" type="number" />
                </div>

                <div>
                    <x-label  for="stock" value="{{ __('Stock') }}" />
                    <x-input wire:model.debounce="variation.stock_qty" id="stock" class="block mt-1 h-8 w-full" type="number" />
                </div>

                <div>
                    <x-label  for="sku" value="{{ __('Sku') }}" />
                    <x-input wire:model.debounce="variation.sku" id="sku" class="block mt-1 h-8 w-full" type="text" />
                </div>

                <div>
                    <x-label  for="weight" value="{{ __('Weight') }}" />
                    <x-input wire:model.debounce="variation.weight" id="sku" class="block mt-1 h-8 w-full" type="number" />
                </div>

                <div>
                    <x-label  for="height" value="{{ __('Height') }}" />
                    <x-input wire:model.debounce="variation.height" id="height" class="block mt-1 h-8 w-full" type="number" />
                </div>

                <div>
                    <x-label  for="Width" value="{{ __('Width') }}" />
                    <x-input wire:model.debounce="variation.width" id="width" class="block mt-1 h-8 w-full" type="number" />
                </div>

                <div>
                    <x-label  for="length" value="{{ __('Length') }}" />
                    <x-input wire:model.debounce="variation.length" id="length" class="block mt-1 h-8 w-full" type="number" />
                </div>

                <div class="col-span-2">
                    <x-label for="parent" value="{{ __('Image') }}" />

                    @if(!$new_image && $old_image)
                        <div class="flex items-center justify-center mb-3">
                            <img class="h-20 h-20 object-contain block" src="{{ $old_image ?? '' }}">
                        </div>
                    @endif

                    @if($new_image)
                        <div>
                            <div class="flex items-center justify-center">
                                @if ($new_image)
                                    <img class="w-20 h-20 object-contain block" src="{{ $new_image->temporaryUrl() }}">
                                @endif
                            </div>
                            <div class="flex items-center justify-center mt-2">
                                <button wire:click.debounce="removeImage" type="button" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
                            </div>
                        </div>
                    @else
                        <div>
                            <div class="flex items-center justify-center">
                                <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-base leading-normal">Change Image</span>
                                    <input wire:model="new_image" type='file' class="hidden" />
                                </label>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="block">
                    <label for="is_published" class="flex items-center">
                        <x-checkbox wire:model.debounce="variation.is_published" id="is_published" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
                    </label>
                </div>


                <div class="flex items-center justify-end">
                    <x-button wire:click.debounce="updateVariation" type="button" class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                    <x-button wire:click.debounce="cancelEditMode" type="button" class="ml-4">
                        {{ __('Cancel') }}
                    </x-button>
                </div>
            </div>
            <x-ui.text-loading-spinner loadingText="Uploading..." wire:loading.flex wire:target="new_image" />
            <x-ui.loading-spinner wire:loading.flex wire:target="cancelEditMode, updateVariation" />
        </div>
    </x-ui.edit-modal>
    @endif
</div>