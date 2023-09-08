<x-front.master-layout title="Home">


    @include('front.partials.intro-slider')
    @include('front.partials.brands-slider')
    <livewire:front.trendy-products-with-caurosel />
    <livewire:front.recent-arrival-products />
    @include('front.partials.selling-feature-banner')

</x-front.master-layout>

