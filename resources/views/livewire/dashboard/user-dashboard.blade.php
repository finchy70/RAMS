<div>
    <x-slot name="header">
        <h2 class="mt-4 font-semibold text-xl text-gray-800 leading-tight">{{auth()->user()->name}} - Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        @if($all)
                            <h1 class="text-2xl font-semibold leading-6 text-gray-900">All RAMS</h1>
                            <p class="mt-2 text-sm text-gray-700">A list of all the RAMS created.</p>
                        @else
                            <h1 class="text-2xl font-semibold leading-6 text-gray-900">Your RAMS</h1>
                            <p class="mt-2 text-sm text-gray-700">A list of all the RAMS you have created.</p>
                        @endif
                    </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <x-button.secondary wire:click='toggle' >
                        @if($all)
                            View Your RAMS
                        @else
                            View All RAMS
                        @endif
                    </x-button.secondary>

                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <x-button.primary wire:click='newRams' >Add New RAMS</x-button.primary>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Job</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Client</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Site</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created By</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($rams as $item)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{$item->job}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{$item->client->name}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{$item->site}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{$item->user->name}}
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <button wire:click="edit({{$item->id}})" class=" py-1 px-2 bg-gray-200 rounded text-indigo-600 hover:text-indigo-900">Edit</button>
                                            <button wire:click="view({{$item->id}})" class="py-1 px-2 bg-gray-200 rounded ml-2 text-indigo-600 hover:text-indigo-900">View</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="p-4">{{$rams->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



