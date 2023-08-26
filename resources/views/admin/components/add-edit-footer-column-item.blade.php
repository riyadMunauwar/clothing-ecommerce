<div>
    @if($is_add_mode_on || $is_edit_mode_on)
    <div class="bg-white rounded-md">
        <x-validation-errors class="mb-4" />

        <div class="grid grid-cols-1 gap-2">

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input wire:model.debounce="name" id="name" class="block h-7 mt-1 w-full" type="text" />
            </div>

            <div>
                <x-label for="link" value="{{ __('Link') }}" />
                <x-input wire:model.debounce="link" id="link" class="block h-7 mt-1 w-full" type="text" />
            </div>

            <div class="block">
                <label for="is_published" class="flex items-center">
                    <x-checkbox wire:model.debounce="is_published" id="is_published" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-2">
                @if(!$is_edit_mode_on)
                    <x-button wire:click.debounce="createFooterColumnItem" class="h-6 px-1 text-xs">
                        {{ __('Add') }}
                    </x-button>
                    <x-button wire:click.debounce="cancelAddColumnItem" class="ml-1 px-1 h-6 text-xs">
                        {{ __('Hide') }}
                    </x-button>
                @else 
                    <x-button wire:click.debounce="updateFooterColumnItem" class="h-6 px-1 text-xs">
                        {{ __('Update') }}
                    </x-button>
                    <x-button wire:click.debounce="cancelAddColumnEditMode" class="ml-1 px-1 h-6 text-xs">
                        {{ __('Cancel') }}
                    </x-button>
                @endif
            </div>
        </div>
    </div>
    @else 
        <div>
            <button wire:click.debounce="enableAddFooterColumnItemMood" class="text-blue-500" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
        </div>
    @endif

    <x-ui.loading-spinner wire:loading.flex wire:target="enableAddFooterColumnItemMood, createFooterColumnItem, cancelAddColumnItem, updateFooterColumnItem, cancelAddColumnEditMode" />
</div>

