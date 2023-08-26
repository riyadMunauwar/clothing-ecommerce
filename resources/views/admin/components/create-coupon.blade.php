<div class="bg-white p-5 rounded-md">
    <h1 class="font-bold text-xl mb-4">Add Coupon</h1>

    <x-validation-errors class="mb-4" />

    <div class="grid grid-cols-1 gap-5">

        <div>
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input wire:model.debounce="name" id="name" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="code" value="{{ __('Code') }}" />
            <x-input wire:model.debounce="code" id="code" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="amount" value="{{ __('Amount') }}" />
            <x-input wire:model.debounce="amount" id="amount" step=any class="block h-8 mt-1 w-full" type="number" />
        </div>

        <div>
            <x-label for="type"  value="{{ __('Discount Type') }}" />
            <x-ui.select wire:model.debounce="type" id="type" class="block h-8 text-sm w-full">
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
            <x-ui.textarea wire:model.debounce="description" id="description" class="block mt-1 w-full"/>
        </div>

        <div class="block">
            <label for="is_active" class="flex items-center">
                <x-checkbox wire:model.debounce="is_active" id="is_active" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Active') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-2">
            <x-button wire:click.debounce="createCoupon" class="ml-4">
                {{ __('Create') }}
            </x-button>
        </div>
    </div>

    <x-ui.loading-spinner wire:loading.flex wire:target="createCoupon" />
</div>


@push('scripts')

@endpush