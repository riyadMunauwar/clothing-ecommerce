<div class="page-content">
    <div class="categories-page">
        <div class="container-fluid">
            <h2 class="title text-center mb-3">Browse Categories</h2>
            <div class="row">

                @foreach($categories as $category)

                        <div style="cursor: pointer" wire:click.debounce="goToCategory({{ $category->id }})" class="col-4 col-sm-3 col-md-2">
                            <div class="banner banner-cat banner-badge">
                                <a>
                                    <img style="aspect-ratio: 1 / 1; object-fit: contain" src="{{ $category->iconUrl('medium') }}" alt="{{ $category->name }}">
                                </a>

                                <a class="banner-link">
                                    <h3 class="banner-title"><span wire:loading.remove wire:target="goToCategory" >{{ $category->name }}</span><span wire:loading wire:target="goToCategory">Loading...</span></h3>
                                    <h4 class="banner-subtitle">{{ $category->products_count }} Products</h4>
                                    <span class="banner-link-text">Shop Now</span>
                                </a>
                            </div>
                        </div>

                @endforeach

            </div>
        </div>
    </div>
</div>