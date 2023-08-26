<div class="bg-white p-5 rounded-md">
    <h1 class="font-bold text-xl mb-4">General Setting</h1>

    <x-validation-errors class="mb-4" />

    <div class="grid grid-cols-1 gap-5">

        <div>
            <x-label for="website_name" value="{{ __('Website Name') }}" />
            <x-input wire:model.debounce="setting.website_name" id="website_name" class="block mt-1 h-9 w-full" type="text" />
        </div>

        <div>
            <x-label for="website_email" value="{{ __('Website Email') }}" />
            <x-input wire:model.debounce="setting.website_email" id="website_email" class="block mt-1 h-9 w-full" type="text" />
        </div>

        <div>
            <x-label for="website_phone" value="{{ __('Website Phone') }}" />
            <x-input wire:model.debounce="setting.website_phone" id="website_phone" class="block mt-1 h-9 w-full" type="text" />
        </div>

        <div>
            <x-label  for="address" value="{{ __('Website Address') }}" />
            <x-ui.textarea wire:model.debounce="setting.address" id="address" class="block mt-1 w-full" type="text" required />
        </div>


        <div>
            <x-label for="gallery" class="mb-1 block" value="{{ __('Favicon') }}" />

            @if(!$new_favicon && $old_favicon)
                <div class="mb-2">
                    <div class="flex items-center justify-center">
                        <img class="w-20 h-20 object-contain block" src="{{ $old_favicon }}">
                    </div>
                </div>
            @endif

            @if($new_favicon)
            <div class="">
                <div class="flex items-center justify-center">
                    @if ($new_favicon)
                        <img class="w-20 h-20 object-contain block" src="{{ $new_favicon->temporaryUrl() }}">
                    @endif
                </div>
                <div class="flex items-center justify-center mt-2">
                    <button wire:click.debounce="removeFavicon" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
                </div>
            </div>
            @else
            <div>
                <div class="flex items-center justify-center">
                    <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-base leading-normal">Select a Favicon</span>
                        <input wire:model="new_favicon" type='file' class="hidden" />
                    </label>
                </div>
            </div>
            @endif
        </div>

        <div>
            <x-label for="gallery" class="mb-1 block" value="{{ __('Logo') }}" />

            @if(!$new_logo && $old_logo)
                <div class="mb-2">
                    <div class="flex items-center justify-center">
                        <img class="w-34 h-20 object-contain block" src="{{ $old_logo }}">
                    </div>
                </div>
            @endif

            @if($new_logo)
            <div class="">
                <div class="flex items-center justify-center">
                    @if ($new_logo)
                        <img class="w-34 h-20 object-contain block" src="{{ $new_logo->temporaryUrl() }}">
                    @endif
                </div>
                <div class="flex items-center justify-center mt-2">
                    <button wire:click.debounce="removeLogo" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
                </div>
            </div>
            @else
            <div>
                <div class="flex items-center justify-center">
                    <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-base leading-normal">Select a Logo</span>
                        <input wire:model="new_logo" type='file' class="hidden" />
                    </label>
                </div>
            </div>
            @endif
        </div>


        <div>
            <x-label  for="metaTitle" value="{{ __('Meta Title') }}" />
            <x-input wire:model.debounce="setting.meta_title" id="metaTitle" class="block mt-1 h-9 w-full" type="text" required />
        </div>

        <div>
            <x-label  for="metaTags" value="{{ __('Meta Tags') }}" />
            <x-input wire:model.debounce="setting.meta_tags" id="metaTags" class="block mt-1 h-9 w-full" type="text" required />
        </div>

        <div>
            <x-label  for="metaDescription" value="{{ __('Meta Description') }}" />
            <x-ui.textarea wire:model.debounce="setting.meta_description" id="metaDescription" class="block mt-1 w-full" type="text" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button wire:click.debounce="saveSetting" class="ml-4">
                {{ __('Save') }}
            </x-button>
        </div>

    </div>

    <x-ui.loading-spinner wire:loading.flex wire:target="removeLogo, removeFavicon" />
    <x-ui.text-loading-spinner loadingText="Uploading..." wire:loading.flex wire:target="new_favicon, new_logo" />
    <x-ui.text-loading-spinner loadingText="Optimizing image and save setting..." wire:loading.flex wire:target="saveSetting" />
</div>
