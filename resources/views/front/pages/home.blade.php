<x-front.master-layout title="Home">

    @include('front.partials.category-collection')
    <livewire:front.trendy-products-with-caurosel />
    <livewire:front.product-collection-with-filter />
    <livewire:front.recent-arrival-products />
    @include('front.partials.selling-feature-banner')

</x-front.master-layout>

