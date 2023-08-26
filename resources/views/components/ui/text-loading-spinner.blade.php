@props(['loadingText' => 'Laoading...'])

<div >
    <div {!! $attributes !!}  style="background-color: rgba(0,0,0, .5)" class="fixed z-50 inset-0 w-full h-screen flex items-center justify-center">
        <div role="status">
            <span class="text-white animate-spin">{{ $loadingText }}</span>
        </div>
    </div>
</div>