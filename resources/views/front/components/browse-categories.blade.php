<div class="page-content">
    <div class="categories-page">
        <div class="container-fluid">
            <h2 class="title text-center mb-3">Browse Categories</h2>

            @if(count($breadCrumbs) > 0)
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container">
                    <ol class="breadcrumb">
                        @foreach($breadCrumbs as $bread)
                            <li class="breadcrumb-item"><a>{{ $bread->name }}</a></li>
                        @endforeach
                    </ol>
                </div>
            </nav>

            @endif

            <div class="row">

                @foreach($categories as $category)

                        <div style="cursor: pointer" wire:click.debounce="goToCategory({{ $category->id }})" class="col-4 col-sm-3 col-md-2">
                            <div class="banner banner-cat banner-badge">
                                <a class="mb-6">
                                    <img src="{{ $category->iconUrl('medium') }}" alt="{{ $category->name }}">
                                </a>

                                <a class="banner-link">
                                    <h3 class="banner-title"><span wire:loading.remove wire:target="goToCategory" >{{ $category->name }}</span><span wire:loading wire:target="goToCategory">Loading...</span></h3>
                                    <h4 class="banner-subtitle">{{ $category->products_count }} Products</h4>
                                    <span class="banner-link-text"><span wire:loading.remove wire:target="goToCategory" >Shop Now</span><span wire:loading wire:target="goToCategory">Loading...</span></span>
                                </a>
                            </div>
                        </div>

                @endforeach

            </div>
        </div>
    </div>
</div>