<div class="bg-white p-5 rounded-md">
    <h1 class="font-bold text-xl mb-4">Add Social Link</h1>

    <x-validation-errors class="mb-4" />

    <div class="grid grid-cols-1 gap-5">

        <div>
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input wire:model.debounce="name" id="name" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="link" value="{{ __('Link') }}" />
            <x-input wire:model.debounce="link" id="link" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="gallery" class="mb-1 block" value="{{ __('Icon') }}" />
            @if($icon)
            <div class="">
                <div class="flex items-center justify-center">
                    @if ($icon)
                        <img class="w-full h-20 rounded-md object-contain block" src="{{ $icon->temporaryUrl() }}">
                    @endif
                </div>
                <div class="flex items-center justify-center mt-2">
                    <button wire:click.debounce="removeIcon" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
                </div>
            </div>
            @else
            <div>
                <div class="flex items-center justify-center">
                    <label class="w-full flex flex-col items-center px-4 py-4 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                        <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-xs leading-normal">Select a Icon</span>
                        <input wire:model="icon" type='file' class="hidden" />
                    </label>
                </div>
            </div>
            @endif
        </div>

        <div class="block">
            <label for="is_published" class="flex items-center">
                <x-checkbox wire:model.debounce="is_published" id="is_published" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button wire:click.debounce="createSocialLink" class="ml-4">
                {{ __('Create') }}
            </x-button>
        </div>

    </div>

    <x-ui.text-loading-spinner loadingText="Uploading..." wire:loading.flex wire:target="icon" />
    <x-ui.text-loading-spinner loadingText="It will take a time for optimizing icon..." wire:loading.flex wire:target="createSocialLink" />
    <x-ui.loading-spinner wire:loading.flex wire:target="removeIcon, createSocialLink, removeIcon" />
</div>
