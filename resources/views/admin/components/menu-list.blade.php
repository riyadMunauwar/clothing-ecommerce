


<section class="bg-white mx-auto max-w-screen-xl rounded-md p-5 md:p-7">
    <h1>Menu</h1>
    
    <div class="mt-5 pb-5">
        <ul class="space-y-1">

            @forelse($menus as $menu)
                <li class="group border px-4 h-12 rounded-md flex gap-3 items-center">

                    @if($menu->iconUrl())
                        <img class="hidden md:block w-9 h-9 rounded-full" src="{{ $menu->iconUrl('thumb') }}" alt="{{ $menu->name }}">
                    @endif

                    <span>{{ $menu->name }}</span>

                    @if($menu->is_published)
                        <span class="hidden md:block bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Published</span>
                    @else
                        <span class="hidden md:block bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Unpublished</span>
                    @endif


                    <span class="hidden md:block bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ ucfirst($menu->type) }}</span>
           

                    @if($menu->category)
                        <span class="hidden md:block bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $menu->category->name ?? ''  }}</span>
                    @elseif($menu->link)
                        <span class="hidden md:block bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $menu->link  }}</span>
                    @endif

                    @if($menu->order)
                        <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ $menu->order }}</span>
                    @endif

                    <div class="group-hover:block hidden ml-auto flex items-center gap-2">
                        <button wire:click.debounce="confirmDeleteMenu({{ $menu->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                        <button wire:click.debounce="enableMenuEditMode({{ $menu->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </button>
                    </div>
                </li>



                @forelse($menu->children as $child)
                    <li class="ml-8 group border px-4 h-12 rounded-md flex gap-3 items-center">

                        @if($child->iconUrl())
                            <img class="hidden md:block w-9 h-9 rounded-full" src="{{ $child->iconUrl('thumb') }}" alt="{{ $menu->name }}">
                        @endif

                        <span>{{ $child->name }}</span>

                        @if($child->is_published)
                            <span class="hidden md:block bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Published</span>
                        @else
                            <span class="hidden md:block bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Unpublished</span>
                        @endif

                        @if($child->category)
                            <span class="hidden md:block bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $child->category->name ?? ''  }}</span>
                        @elseif($child->link)
                            <span class="hidden md:block bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $child->link  }}</span>
                        @endif

                        @if($child->order)
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ $child->order }}</span>
                        @endif

                        <div class="ml-auto group-hover:block hidden flex items-center gap-2">
                            <button wire:click.debounce="confirmDeleteMenu({{ $child->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                            <button wire:click.debounce="enableMenuEditMode({{ $child->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                            <button wire:click.debounce="enableAddNewMenuModal({{ $child->parent_id ?? 0 }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                            </button>
                        </div>
                    </li>

                    @forelse($child->children as $grandChild)
                        <li class="ml-16 group border px-4 h-12 rounded-md flex gap-3 items-center">

                            @if($grandChild->iconUrl())
                                <img class="hidden md:block w-9 h-9 rounded-full" src="{{ $grandChild->iconUrl('thumb') }}" alt="{{ $menu->name }}">
                            @endif

                            <span>{{ $grandChild->name }}</span>

                            @if($grandChild->is_published)
                                <span class="hidden md:block bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Published</span>
                            @else
                                <span class="hidden md:block bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Unpublished</span>
                            @endif

                            @if($grandChild->category)
                                <span class="hidden md:block bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $grandChild->category->name ?? ''  }}</span>
                            @elseif($grandChild->link)
                                <span class="hidden md:block bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $grandChild->link  }}</span>
                            @endif

                            @if($grandChild->order)
                                <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ $grandChild->order }}</span>
                            @endif
                            
                            <div class="ml-auto group-hover:block hidden flex items-center gap-2">
                                <button wire:click.debounce="confirmDeleteMenu({{ $grandChild->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                                <button wire:click.debounce="enableMenuEditMode({{ $grandChild->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>
                                <button wire:click.debounce="enableAddNewMenuModal({{ $grandChild->parent_id ?? 0 }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                </button>
                            </div>
                        </li>


                        @forelse($grandChild->children as $grandGrandChild)
                            <li class="ml-24 group border px-4 h-12 rounded-md flex gap-3 items-center">
                                
                                @if($grandGrandChild->iconUrl())
                                    <img class="hidden md:block w-9 h-9 rounded-full" src="{{ $grandGrandChild->iconUrl('thumb') }}" alt="{{ $menu->name }}">
                                @endif

                                <span>{{ $grandGrandChild->name }}</span>

                                @if($grandGrandChild->is_published)
                                    <span class="hidden md:block bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Published</span>
                                @else
                                    <span class="hidden md:block bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Unpublished</span>
                                @endif

                                @if($grandGrandChild->category)
                                    <span class="hidden md:block bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $grandGrandChild->category->name ?? ''  }}</span>
                                @elseif($grandGrandChild->link)
                                    <span class="hidden md:block bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $grandGrandChild->link  }}</span>
                                @endif

                                @if($grandGrandChild->order)
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ $grandGrandChild->order }}</span>
                                @endif

                                <div class="ml-auto group-hover:block hidden flex items-center gap-2">
                                    <button wire:click.debounce="confirmDeleteMenu({{ $grandGrandChild->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                    <button wire:click.debounce="enableMenuEditMode({{ $grandGrandChild->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    <button wire:click.debounce="enableAddNewMenuModal({{ $grandGrandChild->parent_id ?? 0 }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                        </svg>
                                    </button>
                                </div>
                            </li>
                        @empty
                            <li class="ml-24 border-2 border-dotted px-4 h-12 rounded-md flex justify-end items-center">
                                <div class="flex items-center gap-2">
                                    <button wire:click.debounce="enableAddNewMenuModal({{ $grandChild->id ?? 0 }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                        </svg>
                                    </button>
                                </div>
                            </li>
                        @endforelse

                    @empty
                        <li class="ml-16 border-2 border-dotted px-4 h-12 rounded-md flex justify-end items-center">
                            <div class="flex items-center gap-2">
                                <button wire:click.debounce="enableAddNewMenuModal({{ $child->id ?? 0 }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                </button>
                            </div>
                        </li>
                    @endforelse

                @empty
                    <li class="ml-8 border-2 border-dotted px-4 h-12 rounded-md flex justify-end items-center">
                        <div class="flex items-center gap-2">
                            <button wire:click.debounce="enableAddNewMenuModal({{ $menu->id ?? 0 }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                            </button>
                        </div>
                    </li>
                @endforelse

            @if($loop->last)
                <li class="border-4 border-dotted px-4 h-12 rounded-md flex justify-end items-center">
                    <div class="flex items-center gap-2">
                        <button wire:click.debounce="enableAddNewMenuModal(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                        </button>
                    </div>
                </li>
            @endif

            @empty
                <li class="border-4 border-dotted px-4 h-12 rounded-md flex justify-end items-center">
                    <div class="flex items-center gap-2">
                        <button wire:click.debounce="enableAddNewMenuModal(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                        </button>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>

    <x-ui.loading-spinner wire:loading.flex wire:target="enableMenuEditMode, confirmDeleteMenu, enableAddNewMenuModal" />
</section>


@push('modals')
    <livewire:admin.create-menu />
    <livewire:admin.edit-menu />
@endpush