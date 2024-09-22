<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{auth()->user()->name}} - Methods</h2>
    </x-slot>

    <div class="py-12">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    @if($all)
                        <h1 class="text-2xl font-semibold leading-6 text-gray-900">All Methods</h1>
                        <p class="mt-2 text-sm text-gray-700">A list of all the Methods created.</p>
                    @else
                        <h1 class="text-2xl font-semibold leading-6 text-gray-900">Your Methods</h1>
                        <p class="mt-2 text-sm text-gray-700">A list of all the Methods you have created.</p>
                    @endif
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <x-button.secondary wire:click='toggle' >
                        @if($all)
                            View Your Methods
                        @else
                            View All Methods
                        @endif
                    </x-button.secondary>

                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <x-button.a href="{{route('methods.create')}}" class="py-2 px-4 text-center border rounded-md text-sm leading-5 font-medium focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out border-gray-300 text-gray-700 active:bg-gray-50 active:text-gray-800 hover:text-gray-500">Add New Method</x-button.a>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Description</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Method Category</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Method</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created By</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($methods as $item)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{Str::limit($item->description, 30, '...')}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{$item->methodCategory->category}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{Str::limit(strip_tags($item->method), 80, '...')}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{$item->user->name}}
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <div class="row flex justify-end space-x-2">
                                                <button wire:click="copyMethod({{$item->id}})" class=" py-1 px-2 bg-gray-200 rounded text-indigo-600 hover:text-indigo-900">Copy</button>
                                                <button wire:click="editMethod({{$item->id}})" class=" py-1 px-2 bg-gray-200 rounded text-indigo-600 hover:text-indigo-900">Edit</button>
                                                <a href="{{route('methods.show', $item->id)}}" class="py-1 px-2 bg-gray-200 rounded text-indigo-600 hover:text-indigo-900">View</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="p-4">{{$methods->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



