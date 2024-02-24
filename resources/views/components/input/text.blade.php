@props([
    'leadingAddOn' => false,
])
<div>
    <div class="overflow-hidden flex bg-white shadow-md rounded-md">
        @if ($leadingAddOn)
            <span class="inline-flex rounded-md items-center px-3 border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm hover:u">
                {{ $leadingAddOn }}
            </span>
        @endif

        <input type="text" {{ $attributes->merge(['class' => 'flex-1 rounded-md border-gray-300 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5' . ($leadingAddOn ? ' rounded-none rounded-r-md' : '')]) }}/>

    </div>
</div>
