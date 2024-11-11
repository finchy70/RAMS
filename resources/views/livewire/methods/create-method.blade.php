<div class="px-4 max-w-5xl mx-auto">
    <div class="flex-col space-y-4">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Method Statements
            </h2>
        </x-slot>
        <div class="py-4 space-y-4">
            <div class="flex justify-between">
                <div class="w-1/4">
                    <x-input.text wire:model.live.debounce.350ms="search" placeholder="Search Methods..."></x-input.text>
                </div>
                <div>
                    <select wire:model.live="categoryView" class="text-gray-500 flex-1 rounded-md shadow-md border-gray-300 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="{{null}}">All Method Categories</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category}}</option>
                        @endforeach
                    </select>
                </div>
                <x-button.primary wire:click="create" >
                    New Method
                </x-button.primary>
            </div>

            <x-table>
                <x-slot name="head">
                    <x-table.heading class="text-left" sortable wire:click="sortBy('description')" :direction="$sortDirection" class="w-full">Description</x-table.heading>
                    <x-table.heading class="text-left">Category</x-table.heading>
                    <x-table.heading class="text-right">Options</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($methods as $method)
                        <x-table.row wire:loading.class.delay="opacity-50">
                            <x-table.cell class="overflow-ellipsis overflow-hidden">
                                {{$method->description}}
                            </x-table.cell>
                            <x-table.cell class="overflow-ellipsis overflow-hidden">
                                {{$method->category_asc->category}}
                            </x-table.cell>
                            <x-table.cell class="text-right">
                                <div class="row flex justify-end space-x-2">
                                    <x-button class="!py-1 !px-2 !text-xs" wire:click="duplicate({{$method->id}})">Copy</x-button>
                                    <x-button class="!py-1 !px-2 !text-xs" wire:click="edit({{$method->id}})">Edit</x-button>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="3">
                                <div class="flex justify-center items-center">
                                    <span class="py-8 font-medium text-2xl text-gray-400">
                                        No methods found...
                                    </span>
                                </div>
                            </x-table.cell>

                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>
        <div>
            {{ $methods->links() }}
        </div>
    </div>
    <form wire:submit="save">
        <x-modal.dialog id="modal" maxWidth="5xl" maxHeight="h-fit" wire:model.defer="showEditModal">
            <x-slot name="title">{{$modalTitle}}</x-slot>
            <x-slot name="content">
                <div class="space-y-4">
                    <div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="method_category_id">
                                Method Category
                            </label>
                        </div>

                        <select wire:model="editing.method_category_id" name="method_category_id"
                                class="mt-2 text-sm pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400">
                            <option value="">-- Choose Method Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                        @error('editing.method_category_id')<span class="mt-1 text-red-500 text-sm">{{$message}}</span> @enderror
                    </div>
                    <x-input.group for="title" inline="true" label="Method Description" :error="$errors->first('editing.description')">
                        <x-input.text class="w-full" wire:model="editing.description" name="title"></x-input.text>
                    </x-input.group>

                    <x-input.group class="mt-4" for="method" inline="true" label="Method" :error="$errors->first('editing.method')">
                        <x-input.tinymce wire:model="editing.method" name="method" />
                    </x-input.group>
                </div>



            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">{{$actionButton}}</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
