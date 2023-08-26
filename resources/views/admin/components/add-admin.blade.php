<div>
    @if($is_add_admin_modal_open)
    <x-ui.edit-modal class="max-w-2xl">
        <div class="p-5 md:pl-10 md:pb-10 md:pr-10 bg-white rounded-md">

            <div class="flex justify-end mb-2">
                <span wire:click.debounce="closeAddAdminModal" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>

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
                    <x-button wire:click.debounce="addNewAdmin" type="button" class="ml-4">
                        {{ __('Add') }}
                    </x-button>
                    <x-button wire:click.debounce="closeAddAdminModal" type="button" class="ml-4">
                        {{ __('Cancel') }}
                    </x-button>
                </div>
            </div>

            <x-ui.loading-spinner wire:loading.flex wire:target="closeAddAdminModal, addNewAdmin" />
        </div>
    </x-ui.edit-modal>
    @endif
</div>