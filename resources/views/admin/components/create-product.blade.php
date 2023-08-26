<div class="">
    <div class="grid grid-cols-1 md:grid-cols-6 md:gap-5">
        <div class="col-span-4">
            <div class="rounded-md bg-white p-5 md:p-10">
                <h1 class="font-bold text-xl mb-4">Add Product</h1>
                <x-validation-errors class="mb-4" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div class="col-span-2">
                        <x-label  for="name" value="{{ __('Name') }}" />
                        <x-input wire:model.debounce="name" id="name" class="block mt-1 h-8 w-full" type="text" required />
                    </div>

                    <div class="col-span-2">
                        <x-label for="slug" value="{{ __('Slug') }}" />
                        <x-input wire:model.debounce="slug" id="slug" class="block mt-1 h-8 w-full" type="text" required />
                    </div>

                    <div class="">
                        <x-label for="salePrice" value="{{ __('Sale Price') }}" />
                        <x-input wire:model.debounce="sale_price" id="salePrice" class="block mt-1 h-8 w-full" type="number"/>
                    </div>

                    <div class="">
                        <x-label for="regularPrice" value="{{ __('Regular Price') }}" />
                        <x-input wire:model.debounce="regular_price" id="regularPrice" class="block mt-1 h-8 w-full" type="number"/>
                    </div>

                    
                    <div class="col-span-2 grid grid-cols-3 gap-5 mt-2">
                        <div class="">
                            <x-label for="stock_qty" value="{{ __('Stock Qty') }}" />
                            <x-input wire:model.debounce="stock_qty" id="stock_qty" class="block mt-1 h-8 w-full" type="number" />
                        </div>

                        <div class="">
                            <x-label for="sku" value="{{ __('Sku') }}" />
                            <x-input wire:model.debounce="sku" id="sku" class="block mt-1 h-8 w-full" type="text" />
                        </div>

                        <div class="">
                            <x-label for="weight" value="{{ __('Weight') }}" />
                            <x-input wire:model.debounce="weight" id="weight" class="block mt-1 h-8 w-full" type="number" />
                        </div>
                    </div>

                    <div class="col-span-2 grid grid-cols-3 gap-5 mt-2">
                        <div>
                            <x-label  for="height" value="{{ __('Height') }}" />
                            <x-input wire:model.debounce="height" id="height" class="block mt-1 h-8 w-full" type="number" />
                        </div>
                        <div>
                            <x-label  for="wdith" value="{{ __('Width') }}" />
                            <x-input wire:model.debounce="width" id="wdith" class="block mt-1 h-8 w-full" type="number" />
                        </div>
                        <div>
                            <x-label  for="length" value="{{ __('Length') }}" />
                            <x-input wire:model.debounce="length" id="length" class="block mt-1 h-8 w-full" type="number" />
                        </div>
                    </div>

                </div>
            </div>

            <div class="rounded-md bg-white p-5 md:p-10 md:mt-5">
                <h1 class="font-bold text-xl mb-4">Variations</h1>

                <div>
                    @foreach($variationOptions as $attribute => $values)
                        <div class="grid grid-cols-6 gap-4 mt-2">
                            <div class="">
                                <span class="uppercase bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ strtoupper($attribute) }}</span>
                            </div>
                            <div class="col-span-5 flex flex flex-col gap-2 md:gap-0 md:flex-row">
                                @foreach($values as $value)
                                    <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $value }}</span>
                                @endforeach

                                <button wire:click.debounce="removeAttribute('{{ $attribute }}')" class="text-red-400 ml-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach

                    @if(array_keys($variationOptions))
                        <div class="flex items-center justify-start mt-10">
                            <x-button wire:click.debounce="resetAttributeOptions" type="button">
                                {{ __('Reset') }}
                            </x-button>
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-3 gap-4 mt-5">
                    <div>
                        <x-label  for="attr" value="{{ __('Attribute') }}" />
                        <x-input wire:model.debounce="attributeName" id="attr" class="block mt-1 h-8 w-full" type="text" />
                    </div>
                    <div class="col-span-2">
                        <x-label  for="values" value="{{ __('Value') }}" />
                        <x-input wire:model.debounce="attributeValues" id="values" class="block mt-1 h-8 w-full" type="text" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button wire:click.debounce="addAttribute" type="button" class="ml-4">
                        {{ __('Add') }}
                    </x-button>
                </div>

                @if(array_keys($variationOptions))
                    <div class="flex items-center justify-start mt-10">
                        <x-button wire:click.debounce="createVariations" type="button">
                            {{ __('Generate Variations') }}
                        </x-button>
                    </div>
                @endif


                @php 
                    $variationCount = count($variations);
                @endphp

                <div class="mt-10">


                    @if($variationCount > 0)
                        <h5 class="text-xl font-bold dark:text-white mb-7">Total {{ $variationCount }}</h5>
                    @endif

                    @foreach($variations as $variant)
                        <x-ui.text-loading-spinner loadingText="Uploading..." wire:loading.flex wire:target="variations.{{ $loop->index }}.image" />

                        <div class="p-4 border rounded-md mb-2">
                            <div class="flex flex-col md:flex-row">
                                @foreach($variant['options'] as $attribute => $value)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $value }}</span>
                                @endforeach

                                <button wire:click.debounce="removeVariation({{ $variant['_id'] }})" class="text-red-400 ml-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>

                            <div class="grid grid-cols-6 gap-2 mt-2">

                                <div>
                                    <x-label class="mb-1 block" for="gallery" value="{{ __('Image') }}" />
                                    @if($variant['image'])
                                    <div class="relative">
                                        <div class="flex items-center justify-center">
                                            @if ($variant['image'])
                                                <img class="h-14 rounded-sm object-contain block" src="{{ $variant['image']->temporaryUrl() }}">
                                            @endif
                                        </div>
                                        <div class="flex items-center justify-center mt-2">
                                            <button wire:click.debounce="removeVariantImage({{ $variant['_id'] }})" class="inline-flex items-center px-1 bg-gray-800 border border-transparent rounded-md font-semibold text-[10px] text-white tracking-widest ">Remove</button>
                                        </div>
                                    </div>
                                    @else
                                    <div>
                                        <div class="flex items-center justify-center">
                                            <label class="w-full flex flex-col items-center px-1 py-1 bg-white text-blue rounded-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                                                   <span class="mt-1 text-xs leading-normal">Image</span>
                                                <input wire:model="variations.{{ $loop->index }}.image" type='file' class="hidden" />
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div>
                                    <x-label  for="reg_price" value="{{ __('Regular Price') }}" />
                                    <x-input wire:model.debounce="variations.{{ $loop->index }}.regular_price" id="reg_price" class="block mt-1 h-8 w-full" type="number"/>
                                </div>

                                <div>
                                    <x-label  for="sale_price" value="{{ __('Sale Price') }}" />
                                    <x-input wire:model.debounce="variations.{{ $loop->index }}.sale_price" id="sale_price" class="block mt-1 h-8 w-full" type="number"/>
                                </div>

                                <div>
                                    <x-label  for="stock" value="{{ __('Stock Qty') }}" />
                                    <x-input wire:model.debounce="variations.{{ $loop->index }}.stock_qty" id="stock" class="block mt-1 h-8 w-full" type="number"/>
                                </div>

                                <div>
                                    <x-label  for="sku" value="{{ __('Sku') }}" />
                                    <x-input wire:model.debounce="variations.{{ $loop->index }}.sku" id="sku" class="block mt-1 h-8 w-full" type="text"/>
                                </div>

                                <div>
                                    <x-label  for="weight" value="{{ __('Weight') }}" />
                                    <x-input wire:model.debounce="variations.{{ $loop->index }}.weight" id="weight" class="block mt-1 h-8 w-full" type="number"/>
                                </div>

                                <div>
                                    <x-label  for="height" value="{{ __('Height') }}" />
                                    <x-input wire:model.debounce="variations.{{ $loop->index }}.height" id="height" class="block mt-1 h-8 w-full" type="number"/>
                                </div>

                                <div>
                                    <x-label  for="width" value="{{ __('Width') }}" />
                                    <x-input wire:model.debounce="variations.{{ $loop->index }}.width" id="width" class="block mt-1 h-8 w-full" type="number"/>
                                </div>

                                <div>
                                    <x-label  for="length" value="{{ __('Length') }}" />
                                    <x-input wire:model.debounce="variations.{{ $loop->index }}.length" id="length" class="block mt-1 h-8 w-full" type="number"/>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($variationCount > 0)
                    <div class="flex items-center justify-start mt-10">
                        <x-button wire:click.debounce="removeAllVariation" type="button">
                            {{ __('Remove all') }}
                        </x-button>
                    </div>
                @endif

            </div>

            <div class="rounded-md bg-white p-5 md:p-10 md:mt-5">
                <h1 class="font-bold text-xl mb-4">Description</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div wire:ignore class="col-span-2">
                        <x-label  for="features" class="mb-1 block" value="{{ __('Short Description') }}" />
                        <textarea wire:model.debounce="short_description" id="short_description" >

                        </textarea>
                    </div>

                    <div wire:ignore class="col-span-2">
                        <x-label  for="description" class="mb-1 block" value="{{ __('Description') }}" />
                        <textarea wire:model.debounce="description" id="description" >

                        </textarea>
                    </div>
                </div>
            </div>

            <div class="rounded-md bg-white p-5 md:p-10 md:mt-5">
                <h1 class="font-bold text-xl mb-4">SEO Details</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <x-label  for="meta_title" value="{{ __('Meta Title') }}" />
                        <x-input wire:model.debounce="meta_title" id="meta_title" class="block mt-1 h-8 w-full" type="text"  />
                    </div>
                    <div class="col-span-2">
                        <x-label  for="meta_tags" value="{{ __('Meta Tags') }}" />
                        <x-input wire:model.debounce="meta_tags" id="meta_tags" class="block mt-1 h-8 w-full" type="text" />
                    </div>
                    <div class="col-span-2">
                        <x-label  for="meta_description" value="{{ __('Meta Description') }}" />
                        <x-ui.textarea wire:model.debounce="meta_description" id="meta_description" class="block mt-1 w-full" type="text" />
                    </div>
                </div>
            </div>

        </div>

        <div class="col-span-2">
            <div class="rounded-md bg-white p-5 md:p-10 grid grid-cols-1 gap-5">
                    <div class="space-y-2">
                        <div class="block">
                            <label for="isPublished" class="flex items-center">
                                <x-checkbox wire:model="is_published" id="isPublished" name="remember" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
                            </label>
                        </div>
                        <div class="block">
                            <label for="premium" class="flex items-center">
                                <x-checkbox wire:model="is_premium" id="premium" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Premium') }}</span>
                            </label>
                        </div>
                        <div class="block">
                            <label for="featured" class="flex items-center">
                                <x-checkbox wire:model="is_featured" id="featured" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Featured') }}</span>
                            </label>
                        </div>
                        <div class="block">
                            <label for="featured" class="flex items-center">
                                <x-checkbox wire:model="is_grocery" id="featured" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Grocery') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-5">
                        <x-label for="brand" class="block mb-1" value="{{ __('Brand') }}" />
                        <x-ui.select wire:model.debounce="brand_id" id="brand" class="block h-8 text-sm w-full">
                            <option value="">None</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name ?? '' }}</option>
                            @endforeach
                        </x-ui.select>
                    </div>

                    <div>
                        <x-label  for="youtube_video_url" value="{{ __('Youtube Video Url') }}" />
                        <x-input wire:model.debounce="youtube_video_url" id="youtube_video_url" class="block mt-1 h-8 w-full" type="text"/>
                    </div>

                    <div class="mt-2">
                        <x-label for="gallery" value="{{ __('Category') }}" />
                        <div class="mt-2 p-4 rounded-md bg-gray-50 overflow-auto">
                            @foreach($categories as $category)
                                @if($category->hasChildren())
                                    <div class="block">
                                        <label for="categories" class="flex items-center">
                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $category->id }}" multiple name="categories[]" id="categories" />
                                            <span class="ml-2 text-sm text-gray-600"> {{ $category->name ?? '' }} </span>
                                        </label>
                                        <div class="ml-2 border-l pl-2">
                                            @foreach($category->children as $child)
                                                @if($child->hasChildren())
                                                    <div class="block">
                                                        <label for="categories" class="flex items-center">
                                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $child->id }}" multiple name="categories[]" id="categories" />
                                                            <span class="ml-2 text-sm text-gray-600"> {{ $child->name ?? '' }} </span>
                                                        </label>
                                                        <div class="ml-2 border-l pl-2">
                                                            @foreach($child->children as $grandChild)
                                                                @if($grandChild->hasChildren())
                                                                    <div class="block">
                                                                        <label for="categories" class="flex items-center">
                                                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $grandChild->id }}" multiple name="categories[]" id="categories" />
                                                                            <span class="ml-2 text-sm text-gray-600"> {{ $grandChild->name ?? '' }} </span>
                                                                        </label>
                                                                        <div class="ml-2 border-l pl-2">
                                                                            @foreach($grandChild->children as $grandGrandChild)
                                                                                @if($grandGrandChild->hasChildren())
                                                                                    <div class="block">
                                                                                        <label for="categories" class="flex items-center">
                                                                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $grandGrandChild->id }}" multiple name="categories[]" id="categories" />
                                                                                            <span class="ml-2 text-sm text-gray-600"> {{ $grandGrandChild->name ?? '' }} </span>
                                                                                        </label>
                                                                                        <div class="ml-2 border-l pl-2">
                                                                                            @foreach($grandGrandChild->children as $grandGrandGrandChildren)
                                                                                                @if($grandGrandGrandChildren->hasChildren())
                                                                                                    <div class="block">
                                                                                                        <label for="categories" class="flex items-center">
                                                                                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $grandGrandGrandChildren->id }}" multiple name="categories[]" id="categories" />
                                                                                                            <span class="ml-2 text-sm text-gray-600"> {{ $grandGrandGrandChildren->name ?? '' }} </span>
                                                                                                        </label>
                                                                                                        <div class="ml-2 border-l pl-2">
                                                                                                            @foreach($grandGrandGrandChildren->children as $grandGrandGrandGrandChidlren)
                                                                                                                @if($grandGrandGrandGrandChidlren->hasChildren())
                                                                                                                        <div class="block">
                                                                                                                            <label for="categories" class="flex items-center">
                                                                                                                                <x-checkbox wire:model.debounce="categoriesId" value="{{ $grandGrandGrandGrandChidlren->id }}" multiple name="categories[]" id="categories" />
                                                                                                                                <span class="ml-2 text-sm text-gray-600"> {{ $grandGrandGrandGrandChidlren->name ?? '' }} </span>
                                                                                                                            </label>
                                                                                                                            <div class="ml-2 border-l pl-2">
                                                                                                                                @foreach($grandGrandGrandGrandChidlren->children as $lastChild)
                                                                                                                                    <div class="block">
                                                                                                                                        <label for="categories" class="flex items-center">
                                                                                                                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $lastChild->id }}" multiple name="categories[]" id="categories" />
                                                                                                                                            <span class="ml-2 text-sm text-gray-600"> {{ $lastChild->name ?? '' }} </span>
                                                                                                                                        </label>
                                                                                                                                    </div>
                                                                                                                                @endforeach
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                @else
                                                                                                                    <div class="block">
                                                                                                                        <label for="categories" class="flex items-center">
                                                                                                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $grandGrandGrandGrandChidlren->id }}" multiple name="categories[]" id="categories" />
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
                                                                                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $grandGrandGrandChildren->id }}" multiple name="categories[]" id="categories" />
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
                                                                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $grandGrandChild->id }}" multiple name="categories[]" id="categories" />
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
                                                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $grandChild->id }}" multiple name="categories[]" id="categories" />
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
                                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $child->id }}" multiple name="categories[]" id="categories" />
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
                                            <x-checkbox wire:model.debounce="categoriesId" value="{{ $category->id }}" multiple name="categories[]" id="categories" />
                                            <span class="ml-2 text-sm text-gray-600"> {{ $category->name ?? '' }} </span>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-2">
                        <x-label class="mb-1 block" for="gallery" value="{{ __('Thumbnail') }}" />
                        @if($thumbnail)
                        <div class="mt-3">
                            <div class="flex items-center justify-center">
                                @if ($thumbnail)
                                    <img class="w-full rounded-md block" src="{{ $thumbnail->temporaryUrl() }}">
                                @endif
                            </div>
                            <div class="flex items-center justify-center mt-2">
                                <button wire:click.debounce="removeThumbnail" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
                            </div>
                        </div>
                        @else
                        <div>
                            <div class="flex items-center justify-center">
                                <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-base leading-normal">Select a Image</span>
                                    <input wire:model="thumbnail" type='file' class="hidden" />
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="mt-2">
                        <x-label class="mb-1 block" for="gallery" value="{{ __('Gallery') }}" />
                        @if($gallery)
                        <div class="mt-3">
                            <div class="grid grid-cols-4 gap-5">
                                @if ($gallery)
                                    @foreach($gallery as $image)
                                        <img class="block w-20 h-20 rounded-sm object-cover" src="{{ $image->temporaryUrl() }}">
                                    @endforeach
                                @endif
                            </div>
                            <div class="flex items-center justify-center mt-3">
                                <button wire:click.debounce="removeGallery" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
                            </div>
                        </div>
                        @else
                        <div>
                            <div class="flex items-center justify-center">
                                <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-base leading-normal">Select Image</span>
                                    <input wire:model="gallery" type='file' class="hidden" multiple />
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-end">
                        <x-button wire:click.debounce="createProduct" type="button" class="ml-4">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>

        <x-ui.text-loading-spinner loadingText="It will take a time... we are saving this product and optimizing your image..." wire:loading.flex wire:target="createProduct" />
        <x-ui.text-loading-spinner loadingText="Uploading..." wire:loading.flex wire:target="gallery, thumbnail" />
        <x-ui.loading-spinner wire:loading.flex wire:target="removeAttribute, resetAttributeOptions, addAttribute, removeThumbnail, removeGallery, removeVariation, removeAllVariation, removeVariantImage, createVariations, " />
</div>


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>

    <script>

        'use strict';
      
      
        document.addEventListener('DOMContentLoaded', function() {
            createTinymceInstance('short_description');
            createTinymceInstance('description');
        });



        function createTinymceInstance(selector){
            tinymce.init({
                selector: '#' + selector,
                min_height: 350,
                default_text_color: 'red',
                plugins: [
                    'advlist', 'autoresize', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'pagebreak',
                    'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen',
                ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                image_advtab: true,
                templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                    },
                    {
                    title: 'Test template 2',
                    content: 'Test 2'
                    }
                ],
                content_css: [],
                setup: function (editor) {

                        editor.on('init change', function () {
                            editor.save();
                        });

                        editor.on('change', function (e) {
                            @this.set(selector, editor.getContent());
                        });

                        window.addEventListener('tinymce:clear', function(e){
                            editor.setContent('');
                        })
                }

            });
        }


    </script>
@endpush