<div class="mx-auto max-w-7xl">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{auth()->user()->name}} - Methods</h2>
    </x-slot>

    <div class="py-12">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-semibold leading-6 text-gray-900">All Methods</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the Methods created.</p>
                </div>
                <div class="mt-4 sm:ml-4 sm:mt-0 sm:flex-none">
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
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        <div class="ml-1">Description</div>
                                        <div>
                                            <x-input class="text-xs" type="text" id="searchDescription" name="searchDescription" wire:model.live.debounce.350ms="searchDescription" placeholder="Search Description..."/>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        <div class="ml-1">Method Category</div>
                                        <div>
                                            <select class="w-full text-xs rounded-md shadow-sm overflow-hidden text-gray-500 border-gray-300" type="text" id="searchSelectedMethodCategory" name="searchSelectedMethodCategory" wire:model.live="searchSelectedMethodCategory">
                                                <option class="text-xs" value="9999">All Categories</option>
                                                @foreach($methodCategories as $key=>$methodCategory)
                                                    <option class="text-xs" value="{{$key}}">{{$methodCategory}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        <div class="ml-1">Method</div>
                                        <div>
                                            <x-input class="text-xs w-3/4" type="text" id="searchMethod" name="searchMethod" wire:model.live.debounce.350ms="searchMethod" placeholder="Search Method..."/>
                                        </div>
                                    </th>
                                    <th scope="col" class="py-3.5 pl-2 pr-3 text-left text-sm font-semibold text-gray-900">
                                        <div class="ml-1">Created By</div>
                                        <div>
                                            <select class="w-full text-xs rounded-md shadow-sm overflow-hidden text-gray-500 border-gray-300" type="text" id="searchSelectedUser" name="searchSelectedUser" wire:model.live="searchSelectedUser">
                                                <option class="text-xs" value="9999">All Users</option>
                                                @foreach($users as $key=>$user)
                                                    <option class="text-xs" value="{{$key}}">{{$user}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($methods as $item)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{Str::limit($item->description, 20, '...')}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{$item->methodCategory->category}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{Str::limit(strip_tags($item->method), 50, '...')}}
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



