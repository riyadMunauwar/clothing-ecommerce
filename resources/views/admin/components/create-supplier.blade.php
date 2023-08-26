<div class="bg-white p-5 rounded-md">
    <h1 class="font-bold text-xl mb-4">Add Supplier</h1>

    <x-validation-errors class="mb-4" />

    <div class="grid grid-cols-1 gap-5">

        <div>
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input wire:model.debounce="name" id="name" class="block h-9 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input wire:model.debounce="email" id="email" class="block h-9 mt-1 w-full" type="email" />
        </div>

        
        <div>
            <x-label for="phone" value="{{ __('Phone') }}" />
            <x-input wire:model.debounce="phone" id="phone" class="block h-9 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="city" value="{{ __('City') }}" />
            <x-input wire:model.debounce="city" id="city" class="block h-9 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="state" value="{{ __('State') }}" />
            <x-input wire:model.debounce="state" id="state" class="block h-9 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="country" value="{{ __('Country') }}" />
            <x-input wire:model.debounce="country" id="country" class="block h-9 mt-1 w-full" type="text" />
        </div>
      
        <div>
            <x-label  for="address" value="{{ __('Address') }}" />
            <x-ui.textarea wire:model.debounce="address" id="address" class="block mt-1 w-full"/>
        </div>

        <div>
            <x-label for="contact_person_name" value="{{ __('Contact Person Name') }}" />
            <x-input wire:model.debounce="contact_person_name" id="contact_person_name" class="block h-9 mt-1 w-full" type="text" />
        </div>

        
        <div>
            <x-label for="contact_person_email" value="{{ __('Contact Person Email') }}" />
            <x-input wire:model.debounce="contact_person_email" id="contact_person_name" class="block h-9 mt-1 w-full" type="email" />
        </div>

        
        <div>
            <x-label for="contact_person_phone" value="{{ __('Contact Person Phone') }}" />
            <x-input wire:model.debounce="contact_person_phone" id="contact_person_phone" class="block h-9 mt-1 w-full" type="text" />
        </div>


        <div>
            <x-label for="gallery" class="mb-1 block" value="{{ __('Logo') }}" />
            @if($logo)
            <div class="">
                <div class="flex items-center justify-center">
                    @if ($logo)
                        <img class="w-20 h-20 object-contain block" src="{{ $logo->temporaryUrl() }}">
                    @endif
                </div>
                <div class="flex items-center justify-center mt-2">
                    <button wire:click.debounce="removeLogo" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
                </div>
            </div>
            @else
            <div>
                <div class="flex items-center justify-center">
                    <label class="w-full flex flex-col items-center px-4 py-4 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                        <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-sm leading-normal">Select a Logo</span>
                        <input wire:model="logo" type='file' class="hidden" />
                    </label>
                </div>
            </div>
            @endif
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button wire:click.debounce="createSupplier" class="ml-4">
                {{ __('Create') }}
            </x-button>
        </div>

    </div>

    <x-ui.text-loading-spinner loadingText="Uploading..." wire:loading.flex wire:target="logo" />
    <x-ui.text-loading-spinner loadingText="It will take a time for optimizing image..." wire:loading.flex wire:target="createSupplier" />
    <x-ui.loading-spinner wire:loading.flex wire:target="removeLogo, createSupplier" />
</div>
