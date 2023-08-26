@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block p-2.5 w-full text-md text-gray-900 rounded-lg']) !!}>
    {{ $slot }}
</textarea>