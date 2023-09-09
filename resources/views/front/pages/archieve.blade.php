<x-front.master-layout title="Archieve">


    <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container-fluid">
            <h1 class="page-title">Fullwidth No Sidebar<span>Shop</span></h1>
        </div><!-- End .container-fluid -->
    </div><!-- End .page-header -->

    
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Category</a></li>
            </ol>
        </div><!-- End .container-fluid -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <livewire:front.category-archieve />
    </div>

</x-front.master-layout>