<x-front.master-layout title="Archieve">

    @php 
        $category = \App\Models\Category::select('name')->find(request()->id);
    @endphp


    <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">{{ $category->name ?? '' }}<span>Shop</span></h1>
        </div><!-- End .container-fluid -->
    </div><!-- End .page-header -->

    
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="#{{ $category->name ?? '' }}">{{ $category->name ?? '' }}</a></li>
            </ol>
        </div><!-- End .container-fluid -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <livewire:front.category-archieve />
    </div>

</x-front.master-layout>


@push('scripts')

    <script src="{{ asset('assets/front/js/wNumb.js') }}"></script>

@endpush