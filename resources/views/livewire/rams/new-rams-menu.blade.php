<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{auth()->user()->name}} - {{ __('New RAMS Menu') }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="my-2">
            <label for="prelims" class="text-sm font-medium leading-6 text-gray-900">Preliminaries</label>
            <div class="relative mt-1">
                <select wire:model.live='prelimId' name="prelims" id="prelims" class="w-full border border-gray-200 rounded-lg">
                    <option value='{{null}}' class="block truncate">Please Select a Preliminary</option>
                    @foreach($prelims as $prelim)
                        <option value="{{$prelim->id}}">{{$prelim->title}}</option>
                    @endforeach
                </select>
            </div>
            @if($showPrelimButton)
                <button wire:click='showPrelim({{$prelimId}})' type="button" class="mt-1 px-2 py-1 text-xs bg-indigo-400 rounded-lg text-white font-bold">Show Preliminary</button>
            @endif
        </div>
        <div class="my-2">
            <label for="setup" class="block text-sm font-medium leading-6 text-gray-900">Setup</label>
            <div class="relative mt-2">
                <select wire:model.live='setupId' name="setup" id="setup" class="w-full border border-gray-200 rounded-lg">
                    <option value='{{null}}' class="block truncate">Please Select a Setup</option>
                    @foreach($setups as $setup)
                        <option value="{{$setup->id}}">{{$setup->title}}</option>
                    @endforeach
                </select>
            </div>
            @if($showSetupButton)
                <button wire:click='showSetup({{$setupId}})' type="button" class="mt-1 px-2 py-1 text-xs bg-indigo-400 rounded-lg text-white font-bold">Show Setup</button>
            @endif
        </div>
        <div class="my-2">
            <label for="method" class="block text-sm font-medium leading-6 text-gray-900">Method</label>
            <div class="relative mt-2">
                <select wire:model.live='methodId' name="method" id="method" class="w-full border border-gray-200 rounded-lg">
                    <option value='{{null}}' class="block truncate">Please Select a Method</option>
                    @foreach($methods as $method)
                        <option value="{{$method->id}}">{{$method->description}}</option>
                    @endforeach
                </select>
            </div>
            @if($showMethodButton)
                <button wire:click='showMethod({{$methodId}})' type="button" class="mt-1 px-2 py-1 text-xs bg-indigo-400 rounded-lg text-white font-bold">Show Method</button>
            @endif
        </div>

    </div>
    @if($showModal)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-6xl sm:p-6">
                        <div>
                            <div class="mt-3 text-center sm:mt-5">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">{{$title}}</h3>
                                <div class="mt-2">
                                    <textarea class="text-sm w-full text-gray-500 rounded-xl">{!! $content !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 row flex justify-center">
                            <button wire:click="$set('showModal', false)" type="button" class="w-1/4 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go back to dashboard</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

</div>
