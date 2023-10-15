<x-front.master-layout title="Home">
    <livewire:home-caurosel />

    @include('front.partials.category-collection')
    <livewire:front.browse-categories />
    <livewire:front.trendy-products-with-caurosel />
    <livewire:front.featured-products />
    <livewire:front.recent-arrival-products />
    @include('front.partials.selling-feature-banner')

</x-front.master-layout>

