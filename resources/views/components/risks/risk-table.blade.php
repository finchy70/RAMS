@props([
    'risk'
])

<div class="hidden bg-green-500 bg-yellow-500 bg-red-500"></div>
<div class="max-w-4xl mx-auto">
    <div class="mb-8 grid grid-cols-12 grid-flow-row auto-rows-max">
        <div class="px-2 py-2 col-span-3 text-center font-bold bg-gray-100 border border-gray-700">Operation</div>
        <div class="px-2 py-2 col-span-3 text-center font-bold bg-gray-100 border border-gray-700">Hazard</div>
        <div class="px-2 py-2 col-span-1 text-center font-bold bg-gray-100 border border-gray-700">Pre</div>
        <div class="px-2 py-2 col-span-4 text-center font-bold bg-gray-100 border border-gray-700">Controls</div>
        <div class="px-2 py-2 col-span-1 text-center font-bold bg-gray-100 border border-gray-700">Post</div>
        <div class="px-2 py-2 col-span-3 text-left font-bold border border-gray-700">{{$risk->operation}}</div>
        <div class="px-2 py-2 col-span-3 text-left font-bold border border-gray-700">{{$risk->hazard}}</div>
        <div class="px-2 py-2 col-span-1 text-center font-bold border border-gray-700 {{$risk->pre_control_rating()}}">
            P-{{$risk->pre_probability}}
            <br>
            S-{{$risk->pre_severity}}
        </div>
        <div class="pl-8 pr-2 py-2 col-span-4 text-left font-bold border border-gray-700">
            <ul>
                @foreach($risk->controls as $control)
                    <li class="list-disc">
                        {{$control->control}}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="px-2 py-2 col-span-1 text-center font-bold border border-gray-700 {{$risk->post_control_rating()}}">
            P-{{$risk->post_probability}}
            <br>
            S-{{$risk->post_severity}}
        </div>
        <div class="row flex justify-between col-span-12 px-2 py-1 border border-gray-700">
            <div class="text-left font-bold ">At risk: {{$risk->at_risk}}</div>
            @if(request()->route()->named('risks*'))
                <x-button.secondary class="px-1 py-0 bg-indigo-200 border border-indigo-700">Edit</x-button.secondary>
            @endif
        </div>
    </div>
</div>
