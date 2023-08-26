<div class="bg-white p-5 rounded-md">
    <h1 class="font-bold text-xl mb-4">Add Category</h1>

    <x-validation-errors class="mb-4" />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div class="">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input wire:model.debounce="name" id="name" class="block h-8 mt-1 w-full" type="text" />
        </div>
      
        <div class="">
            <x-label for="slug" value="{{ __('Slug') }}" />
            <x-input wire:model.debounce="slug" id="slug" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div class="">
            <x-label for="order" value="{{ __('Order') }}" />
            <x-input wire:model.debounce="order" id="order" class="block h-8 mt-1 w-full" type="number" />
        </div>

        <div class="col-span-2">
            <x-label for="gallery" value="{{ __('Category') }}" />
            <div class="mt-2 p-4 rounded-md bg-gray-50 overflow-x-auto">
                @foreach($categories as $category)
                    @if($category->hasChildren())
                        <div class="block">
                            <label for="categories" class="flex items-center">
                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $category->id }}" id="categories" />
                                <span class="ml-2 text-sm text-gray-600"> {{ $category->name ?? '' }} </span>
                            </label>
                            <div class="ml-2 border-l pl-2">
                                @foreach($category->children as $child)
                                    @if($child->hasChildren())
                                        <div class="block">
                                            <label for="categories" class="flex items-center">
                                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $child->id }}" id="categories" />
                                                <span class="ml-2 text-sm text-gray-600"> {{ $child->name ?? '' }} </span>
                                            </label>
                                            <div class="ml-2 border-l pl-2">
                                                @foreach($child->children as $grandChild)
                                                    @if($grandChild->hasChildren())
                                                        <div class="block">
                                                            <label for="categories" class="flex items-center">
                                                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $grandChild->id }}" id="categories" />
                                                                <span class="ml-2 text-sm text-gray-600"> {{ $grandChild->name ?? '' }} </span>
                                                            </label>
                                                            <div class="ml-2 border-l pl-2">
                                                                @foreach($grandChild->children as $grandGrandChild)
                                                                    @if($grandGrandChild->hasChildren())
                                                                        <div class="block">
                                                                            <label for="categories" class="flex items-center">
                                                                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $grandGrandChild->id }}" id="categories" />
                                                                                <span class="ml-2 text-sm text-gray-600"> {{ $grandGrandChild->name ?? '' }} </span>
                                                                            </label>
                                                                            <div class="ml-2 border-l pl-2">
                                                                                @foreach($grandGrandChild->children as $grandGrandGrandChildren)
                                                                                    @if($grandGrandGrandChildren->hasChildren())
                                                                                        <div class="block">
                                                                                            <label for="categories" class="flex items-center">
                                                                                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $grandGrandGrandChildren->id }}" id="categories" />
                                                                                                <span class="ml-2 text-sm text-gray-600"> {{ $grandGrandGrandChildren->name ?? '' }} </span>
                                                                                            </label>
                                                                                            <div class="ml-2 border-l pl-2">
                                                                                                @foreach($grandGrandGrandChildren->children as $grandGrandGrandGrandChidlren)
                                                                                                    @if($grandGrandGrandGrandChidlren->hasChildren())
                                                                                                            <div class="block">
                                                                                                                <label for="categories" class="flex items-center">
                                                                                                                    <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $grandGrandGrandGrandChidlren->id }}" id="categories" />
                                                                                                                    <span class="ml-2 text-sm text-gray-600"> {{ $grandGrandGrandGrandChidlren->name ?? '' }} </span>
                                                                                                                </label>
                                                                                                                <div class="ml-2 border-l pl-2">
                                                                                                                    @foreach($grandGrandGrandGrandChidlren->children as $lastChild)
                                                                                                                        <div class="block">
                                                                                                                            <label for="categories" class="flex items-center">
                                                                                                                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $lastChild->id }}" id="categories" />
                                                                                                                                <span class="ml-2 text-sm text-gray-600"> {{ $lastChild->name ?? '' }} </span>
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                    @endforeach
                                                                                                                </div>
                                                                                                            </div>
                                                                                                    @else
                                                                                                        <div class="block">
                                                                                                            <label for="categories" class="flex items-center">
                                                                                                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $grandGrandGrandGrandChidlren->id }}" id="categories" />
                                                                                                                <span class="ml-2 text-sm text-gray-600"> {{ $grandGrandGrandGrandChidlren->name ?? '' }} </span>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    @else 
                                                                                        <div class="block">
                                                                                            <label for="categories" class="flex items-center">
                                                                                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $grandGrandGrandChildren->id }}" id="categories" />
                                                                                                <span class="ml-2 text-sm text-gray-600"> {{ $grandGrandGrandChildren->name ?? '' }} </span>
                                                                                            </label>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="block">
                                                                            <label for="categories" class="flex items-center">
                                                                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $grandGrandChild->id }}" id="categories" />
                                                                                <span class="ml-2 text-sm text-gray-600"> {{ $grandGrandChild->name ?? '' }} </span>
                                                                            </label>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="block">
                                                            <label for="categories" class="flex items-center">
                                                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $grandChild->id }}" id="categories" />
                                                                <span class="ml-2 text-sm text-gray-600"> {{ $grandChild->name ?? '' }} </span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="block">
                                            <label for="categories" class="flex items-center">
                                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $child->id }}" id="categories" />
                                                <span class="ml-2 text-sm text-gray-600"> {{ $child->name ?? '' }} </span>
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="block">
                            <label for="categories" class="flex items-center">
                                <x-ui.radio name="parent_id" wire:model.debounce="parentCategoryId" value="{{ $category->id }}" id="categories" />
                                <span class="ml-2 text-sm text-gray-600"> {{ $category->name ?? '' }} </span>
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="col-span-2">
            <x-label for="gallery" class="mb-1 block" value="{{ __('Icon') }}" />
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

        <div class="col-span-2">
            <x-label  for="description" value="{{ __('Description') }}" />
            <x-ui.textarea wire:model.debounce="description" id="description" class="block h-8 mt-1 w-full" type="text" required />
        </div>

        <div class="col-span-2">
            <x-label  for="metaTitle" value="{{ __('Meta Title') }}" />
            <x-input wire:model.debounce="metaTitle" id="metaTitle" class="block h-8 mt-1 w-full" type="text" required />
        </div>

        <div class="col-span-2">
            <x-label  for="metaTags" value="{{ __('Meta Tags') }}" />
            <x-input wire:model.debounce="metaTags" id="metaTags" class="block h-8 mt-1 w-full" type="text" required />
        </div>

        <div class="col-span-2">
            <x-label  for="metaDescription" value="{{ __('Meta Description') }}" />
            <x-ui.textarea wire:model.debounce="metaDescription" id="metaDescription" class="block mt-1 w-full" type="text" required />
        </div>

        <div class="block">
            <label for="published" class="flex items-center">
                <x-checkbox name="parent_id" wire:model.debounce="isPublished" id="published" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
            </label>
        </div>

        
        <div class="flex items-center justify-end mt-4">
            <x-button wire:click.debounce="createCategory" class="ml-4">
                {{ __('Create') }}
            </x-button>
        </div>

    </div>

    <x-ui.text-loading-spinner loadingText="Uploading icon..." wire:loading.flex wire:target="icon" />
    <x-ui.text-loading-spinner loadingText="creating category and converting media..." wire:loading.flex wire:target="createCategory" />
</div>
