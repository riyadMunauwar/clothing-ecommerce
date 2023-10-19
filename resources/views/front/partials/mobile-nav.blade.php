<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="{{ route('search') }}" method="GET" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="search_query" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>
        
        <nav class="mobile-nav">
            <ul class="mobile-menu">

                @php 
                            
                    $menus = \Illuminate\Support\Facades\Cache::get(config('cache_keys.menu_items_cache_key')); 

                @endphp

                @foreach($menus as $menu)

                    @if(!count($menu->children) > 0)
                        @if($menu->category_id)
                            <li>
                                <a href="{{ route('category_id', ['category_slug' => $menu->category_slug ?? 'categories', 'id' => $menu->category_id]) }}">{{ $menu->name }}</a>
                            </li>
                        @else 
                            <li>
                                <a href="{{ $menu->link }}">{{ $menu->name }}</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a href="#">{{ $menu->name }}</a>

                            <ul>
                                @foreach($menu->children as $child)


                                    @if(!count($child->children) > 0)

                                        @if($child->category_id)
                                            <li><a href="{{ route('category', ['category_slug' => $child->category_slug ?? 'categories', 'id' => $child->category_id]) }}">{{ $child->name }}</a></li>
                                        @else
                                            <li><a href="{{ $child->link }}">{{ $child->name }}</a></li>
                                        @endif

                                    @else
                                        <li>
                                            <a href="#">{{ $child->name }}</a>

                                            <ul>
                                                @foreach($child->children as $grandChild)

                                                    @if($grandChild->category_id)
                                                        <li><a href="{{ route('category', ['category_slug' => $grandChild->category_slug ?? 'categories', 'id' => $grandChild->category_id]) }}">{{ $grandChild->name }}</a></li>
                                                    @else
                                                        <li><a href="{{ $grandChild->link }}">{{ $grandChild->name }}</a></li>
                                                    @endif

                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav><!-- End .mobile-nav -->

        <livewire:front.social-links />
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->