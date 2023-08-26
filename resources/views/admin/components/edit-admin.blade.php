<div>
    @if($is_edit_mode_on)
    <x-ui.edit-modal class="max-w-2xl">
        <div class="p-5 md:p-10 bg-white rounded-md">
            <x-validation-errors class="mb-4" />

            <div class="grid grid-cols-1 gap-5">
                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input wire:model.debounce="name" id="name" class="block h-8 mt-1 w-full" type="text" />
                </div>

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input wire:model.debounce="email" id="email" class="block h-8 mt-1 w-full" type="email" />
                </div>

                <div>
                    <x-label for="role" value="{{ __('Role') }}" />
                    <x-ui.select wire:model.debounce="role" id="role" class="block mt-1 h-9 w-full">
                        <option value="">None</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name ?? '' }}</option>
                        @endforeach
                    </x-ui.select>
                </div>

                <div>
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input wire:model.debounce="password" id="password" class="block h-8 mt-1 w-full" type="text" />
                </div>

                <div>
                    <x-label for="confirm" value="{{ __('Confirm') }}" />
                    <x-input wire:model.debounce="confirm" id="confirm" class="block h-8 mt-1 w-full" type="text" />
                </div>


                <div class="flex items-center justify-end">
                    <x-button wire:click.debounce="updateAdmin" type="button" class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                    <x-button wire:click.debounce="cancelEditMode" type="button" class="ml-4">
                        {{ __('Cancel') }}
                    </x-button>
                </div>
            </div>

            <x-ui.loading-spinner wire:loading.flex wire:target="updateAdmin, cancelEditMode" />
        </div>
    </x-ui.edit-modal>
    @endif
</div>