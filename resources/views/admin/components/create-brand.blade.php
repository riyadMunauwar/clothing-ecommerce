<div class="bg-white p-5 rounded-md">
    <h1 class="font-bold text-xl mb-4">Add Brand</h1>

    <x-validation-errors class="mb-4" />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div class="">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input wire:model.debounce="name" id="name" class="block mt-1 w-full" type="text" />
        </div>
      
        <div class="">
            <x-label for="slug" value="{{ __('Slug') }}" />
            <x-input wire:model.debounce="slug" id="slug" class="block mt-1 w-full" type="text" />
        </div>

        <div class="col-span-2">
            <x-label for="logo" class="mb-1 block" value="{{ __('Logo') }}" />
            @if($new_logo)
            <div class="">
                <div class="flex items-center justify-center">
                    @if ($new_logo)
                        <img class="w-20 h-20 object-contain block" src="{{ $new_logo->temporaryUrl() }}">
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

        <div class="col-span-2">
            <x-label  for="description" value="{{ __('Description') }}" />
            <x-ui.textarea wire:model.debounce="description" id="description" class="block mt-1 w-full" type="text" required />
        </div>

        <div class="col-span-2">
            <x-label  for="metaTitle" value="{{ __('Meta Title') }}" />
            <x-input wire:model.debounce="meta_title" id="metaTitle" class="block mt-1 w-full" type="text" required />
        </div>

        <div class="col-span-2">
            <x-label  for="metaTags" value="{{ __('Meta Tags') }}" />
            <x-input wire:model.debounce="meta_tags" id="metaTags" class="block mt-1 w-full" type="text" required />
        </div>

        <div class="col-span-2">
            <x-label  for="metaDescription" value="{{ __('Meta Description') }}" />
            <x-ui.textarea wire:model.debounce="meta_description" id="metaDescription" class="block mt-1 w-full" type="text" required />
        </div>

        <div class="flex gap-2">

            <div class="block">
                <label for="published" class="flex items-center">
                    <x-checkbox wire:model.debounce="is_published" id="published" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
                </label>
            </div>

            <div class="block">
                <label for="featured" class="flex items-center">
                    <x-checkbox wire:model.debounce="is_featured" id="featured" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Featured') }}</span>
                </label>
            </div> 

        </div>





        
        <div class="flex items-center justify-end mt-4">
            <x-button wire:click.debounce="createBrand" class="ml-4">
                {{ __('Create') }}
            </x-button>
        </div>

    </div>

    <x-ui.text-loading-spinner loadingText="Uploading logo..." wire:loading.flex wire:target="new_logo" />
    <x-ui.loading-spinner  wire:loading.flex wire:target="removeLogo" />
    <x-ui.text-loading-spinner loadingText="creating Brand and converting media..." wire:loading.flex wire:target="createBrand" />
</div>