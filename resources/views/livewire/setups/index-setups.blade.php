<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{auth()->user()->name}} - Setups</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-semibold leading-6 text-gray-900">All Setups</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the Setups created.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <x-button.primary wire:click='newSetup' >Add New Setup</x-button.primary>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="p-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                                        <div class="ml-1">Title</div>
                                        <div>
                                            <x-input class="text-xs" type="text" id="searchTitle" name="searchTitle" wire:model.live.debounce.350ms="searchTitle" placeholder="Search Title..."/>
                                        </div>
                                    </th>
                                    <th scope="col" class="py-3.5 pl-2 pr-3 text-left text-sm font-semibold text-gray-900">
                                        <div class="ml-1">Setup</div>
                                        <div>
                                            <x-input class="text-xs w-3/4" type="text" id="searchSetup" name="searchSetup" wire:model.live.debounce.350ms="searchSetup" placeholder="Search Setup..."></x-input>
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
                                @foreach($setups as $item)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{Str::limit($item->title, 30, '...')}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{Str::limit(strip_tags($item->setup), 80, '...')}}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{$item->user->name}}
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <button wire:click="copySetup({{$item->id}})" class=" py-1 px-2 bg-gray-200 rounded text-indigo-600 hover:text-indigo-900">Copy</button>
                                            <button wire:click="editSetup({{$item->id}})" class=" py-1 px-2 bg-gray-200 rounded text-indigo-600 hover:text-indigo-900">Edit</button>
                                            <a href="{{route('setup.show', $item->id)}}" class="py-1 px-2 bg-gray-200 rounded text-indigo-600 hover:text-indigo-900">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="p-4">{{$setups->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



