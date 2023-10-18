<div>
    @if($is_edit_mode_on)
    <div class="fixed inset-0 overflow-y-scroll pb-20" style="background-color: rgba(0, 0, 0, .50)">
        <div class="bg-white max-w-xl mx-auto rounded-md mt-10">

            <div class="p-5 flex justify-between border-b">
                <h1>Update Menu Item</h1>
                <span wire:click.debounce="cancelEditMode" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>

            <x-validation-errors class="mb-4" />

            <div class="space-y-5 p-5 md:p-7">

                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input wire:model.debounce="name" id="name" class="block h-8 mt-1 w-full" type="text" />
                </div>

                <div>
                    <x-label for="category_id" value="{{ __('Menu Type') }}" />
                    <x-ui.select wire:model.debounce="type" id="type" class="block h-8 text-xs mt-1 w-full">
                        <option value="mega">Mega</option>
                        <option value="dropdown">Dropdown</option>
                    </x-ui.select>
                </div>

                <div>
                    <x-label for="order" value="{{ __('Showing Order') }}" />
                    <x-input wire:model.debounce="order" id="order" class="block h-8 mt-1 w-full" type="number" />
                </div>

                <div class="block">
                    <label for="use_link" class="flex items-center">
                        <x-checkbox wire:model.debounce="is_use_link" id="use_link" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Use link') }}</span>
                    </label>
                </div>

                @if($is_use_link)
                    <div>
                        <x-label for="link" value="{{ __('Link') }}" />
                        <x-input wire:model.debounce="link" id="link" class="block h-8 mt-1 w-full" type="text" />
                    </div>
                @else
                    <div class="">
                        <x-label for="category_id" value="{{ __('Category') }}" />
                        <x-ui.select wire:model.debounce="category_id" id="category_id" class="block h-8 text-xs mt-1 w-full">
                            <option value="">None</option>
                            @foreach($categories ?? [] as $category)
                                <option value="{{ $category->id }}">{{ $category->name ?? '' }} @if($category->parent)<span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"><-{{ $category->parent->name }}</span>@endif</option>
                            @endforeach
                        </x-ui.select>
                    </div>
                @endif

                <div>
                    <x-label for="gallery" class="mb-1 block" value="{{ __('Icon') }}" />
                    
                    @if(!$icon && $old_icon)
                        <div class="flex items-center justify-center mb-3">
                            <img class="h-20 object-contain block" src="{{ $old_icon ?? '' }}">
                        </div>
                    @endif

                    
                    @if($icon)
                    <div class="">
                        <div class="flex items-center justify-center">
                            @if ($icon)
                                <img class="w-20 h-20 object-contain block" src="{{ $icon->temporaryUrl() }}">
                            @endif
                        </div>
                        <div class="flex items-center justify-center mt-2">
                            <button wire:click.debounce="removeIcon" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
                        </div>
                    </div>
                    @else
                    <div>
                        <div class="flex items-center justify-center">
                            <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <span class="mt-2 text-base leading-normal">Select a Icon</span>
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

                <div class="flex items-center justify-end mt-8">
                    <x-button wire:click.debounce="updateMenu" class="ml-4">
                        {{ __('Save') }}
                    </x-button>
                </div>

            </div>
        </div>
    </div>

    <x-ui.loading-spinner wire:loading.flex wire:target="updateMenu, icon, removeIcon, cancelEditMode" />

    @endif
</div>
