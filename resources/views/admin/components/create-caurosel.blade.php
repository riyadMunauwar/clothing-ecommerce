<div class="bg-white p-5 rounded-md">
    <h1 class="font-bold text-xl mb-4">Add Caurosel</h1>

    <x-validation-errors class="mb-4" />

    <div class="grid grid-cols-1 gap-5">

        <div>
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input wire:model.debounce="name" id="name" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="show_in_page" value="{{ __('Show In Page') }}" />
            <x-input wire:model.debounce="show_in_page" id="show_in_page" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div class="block">
            <label for="is_published" class="flex items-center">
                <x-checkbox wire:model.debounce="is_published" id="is_published" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button wire:click.debounce="createCaurosel" class="ml-4">
                {{ __('Create') }}
            </x-button>
        </div>

    </div>

    <x-ui.loading-spinner wire:loading.flex wire:target="createCaurosel" />
</div>
