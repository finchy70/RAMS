<div class="px-4">
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Controls
            </h2>
        </x-slot>

        <div class="space-y-2">
            <div class="max-w-2xl mx-auto flex justify-between">
                <div class="flex items-center">
                    <x-input.text wire:model.live.debounce.350ms="search" placeholder="Search Controls..."></x-input.text>
                    <x-button.secondary wire:click="$set('search', '')" class="ml-2 px-1 py-0 text-xs bg-white border border-black hover:text-indigo-400 hover:border-indigo-400 rounded-md font-bold">Clear</x-button.secondary>
                </div>

                <x-button.primary class="font-bold" wire:click="create" >
                    New Control
                </x-button.primary>
            </div>
            <div class="max-w-6xl mx-auto">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortDirection">Description</x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('control')" :direction="$sortDirection">Control</x-table.heading>
                        <x-table.heading class="text-left">Type</x-table.heading>
                        <x-table.heading class="text-right">Options</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @forelse($controls as $control)
                            <x-table.row wire:loading.class.delay="opacity-50">
                                <x-table.cell class="overflow-ellipsis overflow-hidden">
                                    {{strip_tags($control->control_description)}}
                                </x-table.cell>
                                <x-table.cell class="overflow-ellipsis overflow-hidden">
                                    {{Str::limit(strip_tags($control->control), 75, '...')}}
                                </x-table.cell>
                                <x-table.cell class="overflow-ellipsis overflow-hidden">
                                    {{$control->type_asc->type}}
                                </x-table.cell>
                                <x-table.cell class="text-right">
                                    <div class="row flex justify-end space-x-2">
                                        <button class='text-xs border border-1 border-gray-400 p-1 rounded-md hover:bg-gray-100' type="button" wire:click="duplicate({{$control->id}})">Copy</button>
                                        <button class='text-xs border border-1 border-gray-400 p-1 rounded-md hover:bg-gray-100' type="button" wire:click="edit({{$control->id}})">Edit</button>
                                        <button class='text-xs border border-1 border-gray-400 p-1 rounded-md hover:bg-gray-100' type="button" wire:click="view({{$control->id}})">View</button>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row>
                                <x-table.cell colspan="3">
                                    <div class="flex justify-center items-center">
                                        <span class="py-8 font-medium text-2xl text-gray-400">
                                            No controls found...
                                        </span>
                                    </div>
                                </x-table.cell>

                            </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table>
            </div>
        </div>
        <div>
            {{ $controls->links() }}
        </div>
    </div>
    @if($showEditModal)
        <form wire:submit.prevent="save">
            <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl sm:p-6">
                            <div name="content">
                                <div class="text-2xl">{{$modalTitle}}</div>
                                <hr class="my-2">
                                <div class="row flex justify-between space-x-8">
                                    <div class="w-full">
                                        <label class="block font-medium text-sm text-gray-700" for="editing.control_description">
                                            Control Description
                                        </label>
                                        <input wire:model="editing.control_description" type="text" class="w-full text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 py-2 focus:outline-none focus:border-blue-400"/>
                                        @error('editing.control_type_id')<span class="mt-1 text-red-500 text-sm">{{$message}}</span> @enderror
                                    </div>
                                    <div class="w-full">
                                        <label class="block font-medium text-sm text-gray-700" for="editing.method_category_id">
                                            Control Type
                                        </label>
                                        <select wire:model="editing.control_type_id" name="editing.control_type_id"
                                                class="w-full text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 py-2 focus:outline-none focus:border-blue-400">
                                            <option value="">-- Choose Control Type --</option>
                                            @foreach ($control_types as $type)
                                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                                            @endforeach
                                        </select>
                                        @error('editing.control_type_id')<span class="mt-1 text-red-500 text-sm">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <x-input.group for="control" inline="true" label="Control" :error="$errors->first('editing.control')">
                                        <x-input.textarea rows="10" wire:model="editing.control"></x-input.textarea>
                                    </x-input.group>
                                </div>
                            </div>
                            <div class="row flex justify-end space-x-4">
                                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                                <x-button.primary type="submit">Save</x-button.primary>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
    @if($showViewModal)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl sm:p-6">
                        <div name="content">
                            <div class="text-xl">View Control - {{$showControl->control_description}}</div>
                            <hr class="my-2">
                            <div class="row flex justify-between space-x-8">
                                <div class="p-4 w-full space-y-4">
                                    <div>
                                        <div class="text-sm font-bold">
                                            Control Description
                                        </div>
                                        <hr class="my-2">
                                        <div class="text-xs">
                                            {{$showControl->control_description}}
                                        </div>

                                    </div>
                                    <hr class="border-red-500">
                                    <div>
                                        <div class="text-sm font-bold">
                                            Control
                                        </div>
                                        <hr class="my-2">
                                        <div class="text-xs">
                                            {{$showControl->control}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row flex justify-end space-x-4">
                            <x-button.secondary wire:click="$set('showViewModal', false)">Close</x-button.secondary>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
