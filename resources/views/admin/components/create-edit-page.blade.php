<div>
    <div class="rounded-md bg-white p-5 md:p-10">
        <h1 class="font-bold text-xl mb-4">
            @if($is_edit_mode_on)
                Edit Page
            @else 
                Add Page
            @endif
        </h1>
        <x-validation-errors class="mb-4" />

        <div class="grid grid-cols-1 gap-4">

            <div class="col-span-2">
                <x-label  for="name" value="{{ __('Name') }}" />
                <x-input wire:model.debounce="name" id="name" class="block mt-1 h-8 w-full" type="text" required />
            </div>

            <div class="col-span-2">
                <x-label for="slug" value="{{ __('Slug') }}" />
                <x-input wire:model.debounce="slug" id="slug" class="block mt-1 h-8 w-full" type="text" required />
            </div>

            <div class="block">
                <label for="isPublished" class="flex items-center">
                    <x-checkbox wire:model="is_published" id="isPublished" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
                </label>
            </div>

        </div>
    </div>

    <div class="rounded-md bg-white p-5 md:p-10 md:mt-5">
        <h1 class="font-bold text-xl mb-4">Page Content</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div wire:ignore class="col-span-2">
                <x-label  for="content" class="mb-1 block" value="{{ __('Content') }}" />
                <textarea wire:model.debounce="content" id="content" >

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

        <div class="flex items-center justify-end mt-8">
            @if($is_edit_mode_on)
                <x-button wire:click.debounce="updatePage" class="ml-4">
                    {{ __('update') }}
                </x-button>                
                <x-button wire:click.debounce="cancelEditMode" class="ml-4">
                    {{ __('cancel') }}
                </x-button>
            @else
                <x-button wire:click.debounce="createPage" class="ml-4">
                    {{ __('Create') }}
                </x-button>
            @endif
        </div>

    </div>


    <x-ui.loading-spinner wire:loading.flex wire:target="cancelEditMode, createPage, updatePage" />
</div>


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>

    <script>
        'use strict';
      
        document.addEventListener('DOMContentLoaded', function() {
            createTinymceInstance('content');
        });

        function createTinymceInstance(selector){
            tinymce.remove('#' + selector)
            tinymce.init({
                selector: '#' + selector,
                min_height: 550,
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
                            editor.setContent(e.detail);
                        })
                }

            });
        }


    </script>
@endpush