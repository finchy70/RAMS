@props([
    'risk'
])

<div class="max-w-6xl mx-auto">
    <div class="mb-8 grid grid-cols-12 grid-flow-row auto-rows-max border-2 border-gray-900 rounded-xl shadow-2xl overflow-hidden">
        <div class="px-2 py-2 text-xs col-span-3 text-center font-bold bg-gray-100 border-b border-r rounded-tl-xl border-gray-500">Operation</div>
        <div class="px-2 py-2 text-xs col-span-3 text-center font-bold bg-gray-100 border-b border-r border-gray-500">Hazard</div>
        <div class="px-2 py-2 text-xs col-span-1 text-center font-bold bg-gray-100 border-b border-r border-gray-500">Pre</div>
        <div class="px-2 py-2 text-xs col-span-4 text-center font-bold bg-gray-100 border-b border-r border-gray-500">Controls</div>
        <div class="px-2 py-2 text-xs col-span-1 text-center font-bold bg-gray-100 border-b border-gray-500 rounded-tr-xl">Post</div>
        <div class="px-2 py-2 text-xs col-span-3 text-left font-bold border-r border-b border-gray-500">{{$risk->operation}}</div>
        <div class="px-2 py-2 text-xs col-span-3 text-left font-bold border-r border-b border-gray-500">{{$risk->hazard}}</div>
        <div class="px-2 py-2 text-xs col-span-1 text-center font-bold border-r border-b border-gray-500 {{$risk->pre_control_rating()}}">
            P-{{$risk->pre_probability}}
            <br>
            S-{{$risk->pre_severity}}
        </div>
        <div class="pl-8 pr-2 py-2 col-span-4 text-left text-xs font-bold border-r border-b border-gray-500">
            <ul>
                @foreach($risk->controls as $control)
                    <li class="list-disc">
                        {{$control->control}}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="px-2 py-2 col-span-1 text-center text-xs font-bold border-b border-gray-500 {{$risk->post_control_rating()}}">
            P-{{$risk->post_probability}}
            <br>
            S-{{$risk->post_severity}}
        </div>
        <div class="row flex justify-between text-xs col-span-12 px-2 py-1 border-gray-500 items-center">
            <div class="text-left font-bold py-4">At risk: {{$risk->at_risk}}</div>
            @if(request()->route()->named('risks*'))
                <div>
                    <x-button.secondary class="!px-2 !py-1 text-xs !text-gray-900 bg-gray-200 border !border-black">Edit</x-button.secondary>
                </div>

            @endif
        </div>
    </div>
</div>
