<div class="px-4">
    <div class="flex-col space-y-4">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage PPE
            </h2>
        </x-slot>
        <div class="max-w-3xl mx-auto py-4 space-y-4">
            <div class="flex justify-between">
                <div class="w-1/4">
                    <x-input.text wire:model.live.debounce.350ms="search" placeholder="Search PPE..."></x-input.text>
                </div>
                <x-button.primary wire:click="create" >
                    New PPE
                </x-button.primary>
            </div>

            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable wire:click="sortBy('item')" :direction="$sortDirection" class="w-full">Item</x-table.heading>
                    <x-table.heading class="text-right">Options</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($ppes as $ppe)
                        <x-table.row wire:loading.class.delay="opacity-50">
                            <x-table.cell>
                                {{$ppe->item}}
                            </x-table.cell>
                            <x-table.cell class="text-right">
                                <div class="row flex justify-end">
                                    <x-button.link wire:click="edit({{$ppe->id}})">Edit</x-button.link>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="2">
                                <div class="flex justify-center items-center">
                                    <span class="py-8 font-medium text-2xl text-gray-400">
                                        No PPE found...
                                    </span>
                                </div>
                            </x-table.cell>

                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>
        <div>
            {{ $ppes->links() }}
        </div>
    </div>
    <form wire:submit.prevent="save">
        @if($showEditModal)
            <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl sm:p-6">
                            <div name="content">
                                <div class="text-2xl">{{$modalTitle}}</div>
                                <hr class="my-2">
                                <div class="row flex justify-between space-x-8">
                                    <div class="w-full space-y-2">
                                        <label class="mt-2 block font-medium text-sm text-gray-700" for="editing.control_description">
                                            PPE
                                        </label>
                                        <input wire:model="editing.item" type="text" class="w-full text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 py-2 focus:outline-none focus:border-blue-400"/>
                                        @error('editing.item')<span class="mt-1 text-red-500 text-sm">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 row flex justify-end space-x-4">
                                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                                <x-button.primary type="submit">{{$actionButton}}</x-button.primary>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
