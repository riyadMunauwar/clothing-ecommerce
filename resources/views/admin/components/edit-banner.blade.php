<div>
    @if($is_edit_mode_on)
    <x-ui.edit-modal class="max-w-2xl">
        <div class="p-5 md:pr-10 md:pb-10 md:pl-10 bg-white rounded-md">

            <div class="flex justify-end mb-2">
                <span wire:click.debounce="cancelEditMode" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>

            <x-validation-errors class="mb-4" />

            <div class="grid grid-cols-1 gap-5">

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input wire:model.debounce="banner.name" id="name" class="block h-8 mt-1 w-full" type="text" />
            </div>

            <div>
                <x-label for="show_in_page" value="{{ __('Show In Page') }}" />
                <x-input wire:model.debounce="banner.show_in_page" id="show_in_page" class="block h-8 mt-1 w-full" type="text" />
            </div>

            <div>
                <x-label for="banner_link" value="{{ __('Banner Link') }}" />
                <x-input wire:model.debounce="banner.banner_link" id="banner_link" class="block h-8 mt-1 w-full" type="text" />
            </div>

                <div>
                    <x-label for="parent" value="{{ __('image') }}" />

                    @if(!$new_image && $old_image)
                        <div class="flex items-center justify-center mb-3">
                            <img class="w-full rounded-md h-20 object-contain block" src="{{ $old_image ?? '' }}">
                        </div>
                    @endif

                    @if($new_image)
                        <div>
                            <div class="flex items-center justify-center">
                                @if ($new_image)
                                    <img class="w-full h-20 rounded-md object-contain block" src="{{ $new_image->temporaryUrl() }}">
                                @endif
                            </div>
                            <div class="flex items-center justify-center mt-2">
                                <button wire:click.debounce="removeImage" type="button" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
                            </div>
                        </div>
                    @else
                        <div>
                            <div class="flex items-center justify-center">
                                <label class="w-full flex flex-col items-center px-4 py-4 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                                    <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-sm leading-normal">Change image</span>
                                    <input wire:model="new_image" type='file' class="hidden" />
                                </label>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="block">
                    <label for="is_published" class="flex items-center">
                        <x-checkbox wire:model.debounce="banner.is_published" id="is_published" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end">
                    <x-button wire:click.debounce="updateBanner" type="button" class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                    <x-button wire:click.debounce="cancelEditMode" type="button" class="ml-4">
                        {{ __('Cancel') }}
                    </x-button>
                </div>
            </div>
            <x-ui.text-loading-spinner loadingText="Uploading..." wire:loading.flex wire:target="new_image" />
            <x-ui.loading-spinner wire:loading.flex wire:target="cancelEditMode, removeImage" />
            <x-ui.text-loading-spinner loadingText="Saving banner and optimizing image..." wire:loading.flex wire:target="updateBanner" />
        </div>
    </x-ui.edit-modal>
    @endif
</div>