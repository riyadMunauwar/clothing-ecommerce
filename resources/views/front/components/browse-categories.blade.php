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

                                <a class="banner-link" href="#">
                                    <h3 class="banner-title">{{ $category->name }}</h3><!-- End .banner-title -->
                                    <h4 class="banner-subtitle">{{ $category->products_count }} Products</h4><!-- End .banner-subtitle -->
                                    <span class="banner-link-text">Shop Now</span>
                                </a><!-- End .banner-link -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-sm-8 -->

                @endforeach

            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .categories-page -->
</div><!-- End .page-content -->