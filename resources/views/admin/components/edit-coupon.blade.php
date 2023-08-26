<div>
    @if($is_edit_mode_on)
    <x-ui.edit-modal class="max-w-2xl">
        <div class="p-5 md:pb-10 md:pl-10 md:pr-10 bg-white rounded-md">

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
                    <x-input wire:model.debounce="coupon.name" id="name" class="block h-8 mt-1 w-full" type="text" />
                </div>

                <div>
                    <x-label for="code" value="{{ __('Code') }}" />
                    <x-input wire:model.debounce="coupon.code" id="code" class="block h-8 mt-1 w-full" type="text" />
                </div>

                <div>
                    <x-label for="amount" value="{{ __('Amount') }}" />
                    <x-input wire:model.debounce="coupon.amount" id="amount" step=any class="block h-8 mt-1 w-full" type="number" />
                </div>

                <div>
                    <x-label for="type"  value="{{ __('Discount Type') }}" />
                    <x-ui.select wire:model.debounce="coupon.type" id="type" class="block h-8 text-sm w-full">
                        <option value="fixed">Fixed</option>
                        <option value="percent">Percent</option>
                    </x-ui.select>
                </div>

                <div>
                    <x-label for="start_date" value="{{ __('Start Date') }}" />
                    <x-input wire:model.debounce="start_date" id="start_date"  class="h-8 mt-1 w-full" type="date" />
                </div>

                <div>
                    <x-label for="end_date" value="{{ __('End Date') }}" />
                    <x-input wire:model.debounce="end_date" id="end_date"  class="block h-8 mt-1 w-full" type="date" />
                </div>

                <div>
                    <x-label  for="description" value="{{ __('Description') }}" />
                    <x-ui.textarea wire:model.debounce="coupon.description" id="description" class="block mt-1 w-full"/>
                </div>

                <div class="block">
                    <label for="is_active" class="flex items-center">
                        <x-checkbox wire:model.debounce="coupon.is_active" id="is_active" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Active') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end">
                    <x-button wire:click.debounce="updateCoupon" type="button" class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                    <x-button wire:click.debounce="cancelEditMode" type="button" class="ml-4">
                        {{ __('Cancel') }}
                    </x-button>
                </div>

            </div>

            <x-ui.loading-spinner wire:loading.flex wire:target="updateCoupon, cancelEditMode" />
        </div>
    </x-ui.edit-modal>
    @endif
</div>