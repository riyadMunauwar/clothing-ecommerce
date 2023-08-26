<div>
    <div class="rounded-md bg-white p-5 md:p-10">
        <h1 class="font-bold text-xl mb-4">
            @if($is_edit_mode_on)
                Edit Guide
            @else 
                Add Guide
            @endif
        </h1>
        <x-validation-errors class="mb-4" />

        <div class="grid grid-cols-1 gap-4">

            <div class="col-span-2">
                <x-label  for="title" value="{{ __('Title') }}" />
                <x-input wire:model.debounce="title" id="title" class="block mt-1 h-8 w-full" type="text" required />
            </div>

            <div class="col-span-2">
                <x-label for="slug" value="{{ __('Slug') }}" />
                <x-input wire:model.debounce="slug" id="slug" class="block mt-1 h-8 w-full" type="text" required />
            </div>

            <div class="col-span-2">
                <x-label for="guide_youtube_video_url" value="{{ __('Youtube Video Url') }}" />
                <x-input wire:model.debounce="guide_youtube_video_url" id="guide_youtube_video_url" class="block mt-1 h-8 w-full" type="text" required />
            </div>

            <div class="col-span-2">
                <x-label for="show_in_page" value="{{ __('Show In Page') }}" />
                <x-input wire:model.debounce="show_in_page" id="show_in_page" class="block mt-1 h-8 w-full" type="text" required />
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
        <h1 class="font-bold text-xl mb-4">Guide Content</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div wire:ignore class="col-span-2">
                <x-label  for="content" class="mb-1 block" value="{{ __('Content') }}" />
                <textarea wire:model.debounce="content" id="content" ></textarea>
            </div>
        </div>

        <div class="flex items-center justify-end mt-8">
            @if($is_edit_mode_on)
                <x-button wire:click.debounce="updateGuide" class="ml-4">
                    {{ __('update') }}
                </x-button>                
                <x-button wire:click.debounce="cancelEditMode" class="ml-4">
                    {{ __('cancel') }}
                </x-button>
            @else
                <x-button wire:click.debounce="createGuide" class="ml-4">
                    {{ __('Create') }}
                </x-button>
            @endif
        </div>
    </div>

    <x-ui.loading-spinner wire:loading.flex wire:target="cancelEditMode, createGuide, updateGuide" />
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