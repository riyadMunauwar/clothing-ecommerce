<x-front.master-layout title="Home">
    @include('front.partials.full-width-intro-caurosel')

    @include('front.partials.category-collection')
    <livewire:front.browse-categories />
    <livewire:front.trendy-products-with-caurosel />
    <livewire:front.featured-products />
    <livewire:front.recent-arrival-products />
    @include('front.partials.selling-feature-banner')

</x-front.master-layout>

