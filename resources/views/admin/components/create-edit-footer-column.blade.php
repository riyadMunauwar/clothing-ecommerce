<div class="bg-white p-5 rounded-md">
    <h1 class="font-bold text-xl mb-4">
        @if($is_edit_mode_on)
            Update Footer Column
        @else 
            Add Footer Column
        @endif
    </h1>

    <x-validation-errors class="mb-4" />

    <div class="grid grid-cols-1 gap-5">

        <div>
            <x-label for="column_title" value="{{ __('Name') }}" />
            <x-input wire:model.debounce="column_title" id="column_title" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div class="block">
            <label for="is_published" class="flex items-center">
                <x-checkbox wire:model.debounce="is_published" id="is_published" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if($is_edit_mode_on)
                <x-button wire:click.debounce="updateFooterColumn" class="">
                    {{ __('Update') }}
                </x-button>
                <x-button wire:click.debounce="cancelEditMode" class="ml-2">
                    {{ __('Cancel') }}
                </x-button>
            @else
                <x-button wire:click.debounce="createFooterColumn" class="ml-4">
                    {{ __('Create') }}
                </x-button>
            @endif
        </div>

    </div>

    <x-ui.loading-spinner wire:loading.flex wire:target="cancelEditMode, updateFooterColumn, createFooterColumn" />
</div>
