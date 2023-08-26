<div class="">
    @if($is_edit_mode_on)
    <x-ui.edit-modal class="max-w-6xl bg-white p-5 md:pl-10 md:pr-10 md:pb-10 rounded-md" >
    <div class="flex justify-end mb-5">
        <span wire:click.debounce="cancelEditMode" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </span>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-6 md:gap-5">
        <div class="col-span-4">
            <div class="rounded-md bg-white p-5 md:p-10 border">
                <h1 class="font-bold text-xl mb-4">Edit Product</h1>
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


            <div class="rounded-md bg-white p-5 md:p-10 md:mt-5 border">
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

            <div class="rounded-md bg-white p-5 md:p-10 md:mt-5 border">
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
            <div class="rounded-md bg-white p-5 md:p-10 grid grid-cols-1 gap-5 border">
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
                        @if (!$thumbnail && $old_thumbnail)
                            <div class="flex items-center justify-center mb-2">
                                <img class="w-full rounded-md block" src="{{ $old_thumbnail }}">
                            </div>
                        @endif

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
                                <label class="w-full flex flex-col items-center px-2 py-2 bg-white text-blue rounded-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                                    <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-1 text-xs leading-normal">Change Thumbnail</span>
                                    <input wire:model="thumbnail" type='file' class="hidden" />
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="mt-2">
                        <x-label class="mb-1 block" for="gallery" value="{{ __('Gallery') }}" />
                        @if (count($old_gallery) > 0)
                        <div class="mt-3">
                            <div class="grid grid-cols-3 gap-2">
                                @foreach($old_gallery as $image)
                                <div class="group relative">
                                    <img class="block w-20 h-20 border rounded-sm object-cover" src="{{ $image->getUrl('thumb') }}">
                                    <div style="background-color: rgba(0, 0, 0, .6)" class="group-hover:block hidden absolute inset-0 w-full h-full">
                                        <button wire:click.debounce="removeGalleryItem({{ $image->id }})" class="group-hover:block hidden absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-50 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($gallery)
                        <div class="mt-3">
                            <div class="grid grid-cols-3 gap-2">
                                @if ($gallery)
                                    @foreach($gallery as $image)
                                        <img class="block w-20 h-20 border rounded-sm object-cover" src="{{ $image->temporaryUrl() }}">
                                    @endforeach
                                @endif
                            </div>
                            <div class="flex items-center justify-center mt-3">
                                <button wire:click.debounce="removeGallery" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
                            </div>
                        </div>
                        @else
                        <div class="mt-3">
                            <div class="flex items-center justify-center">
                                <label class="w-full flex flex-col items-center px-2 py-2 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                                    <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-1 text-xs leading-normal">Change Gallery</span>
                                    <input wire:model="gallery" type='file' class="hidden" multiple />
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-end">
                        <x-button wire:click.debounce="updateSave" type="button" class="ml-4">
                            {{ __('Update') }}
                        </x-button>

                        <x-button wire:click.debounce="cancelEditMode" type="button" class="ml-4">
                            {{ __('Cancel') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>

        <x-ui.text-loading-spinner loadingText="It will take a time... we are saving this product and optimizing your image..." wire:loading.flex wire:target="updateSave" />
        <x-ui.text-loading-spinner loadingText="Uploading..." wire:loading.flex wire:target="gallery, thumbnail" />
        <x-ui.loading-spinner wire:loading.flex wire:target="cancelEditMode, removeGalleryItem, removeThumbnail, removeGallery" />
        </x-ui.edit-modal>
        @endif
</div>


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>

    <script>

        'use strict';
      
      
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('tinymce:init', function(e){
                createTinymceInstance('short_description');
                createTinymceInstance('description');
            })
        });



        function createTinymceInstance(selector){
            tinymce.remove('#' + selector)
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

                        window.addEventListener('tinymce:set:' + selector, function(e){
                            editor.setContent(selector, e.detail);
                        })
                }

            });
        }


    </script>
@endpush