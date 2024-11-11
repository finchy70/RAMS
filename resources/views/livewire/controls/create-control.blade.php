<div class="px-4 max-w-5xl mx-auto">
    <div class="flex-col space-y-4">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Setup
            </h2>
        </x-slot>
        <div class="py-4 space-y-4">
            <div class="flex justify-between">
                <div class="w-1/4">
                    <x-input.text wire:model.live.debounce.350ms="search" placeholder="Search Setups..."></x-input.text>
                </div>
                <x-button.primary wire:click="create" >
                    New Control
                </x-button.primary>
            </div>

            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable wire:click="sortBy('control_description')" :direction="$sortDirection" class="w-full">Title</x-table.heading>
                    <x-table.heading class="text-right">Options</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($controls as $control)
                        <x-table.row wire:loading.class.delay="opacity-50">
                            <x-table.cell>
                                {{$control->control_description}}
                            </x-table.cell>
                            <x-table.cell class="text-right">
                                <div class="row flex justify-end">
                                    <x-button class="mr-4 !px-2 !py-1 !text-xs" wire:click="duplicate({{$control->id}})">Copy</x-button>
                                    <x-button class="!px-2 !py-1 !text-xs" wire:click="edit({{$control->id}})">Edit</x-button>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="2">
                                <div class="flex justify-center items-center">
                                    <span class="py-8 font-medium text-2xl text-gray-400">
                                        No setups found...
                                    </span>
                                </div>
                            </x-table.cell>

                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>
        <div>
            {{ $controls->links() }}
        </div>
    </div>
    <form wire:submit="save">
        <form wire:submit="save">
            <x-modal.dialog id="modal" maxWidth="5xl" maxHeight="h-fit" wire:model.defer="showEditModal">
                <x-slot name="title">{{$modalTitle}}</x-slot>
                <x-slot name="content">
                    <div class="space-y-4">
                        <div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="editing.control_type_id">
                                    Control Type
                                </label>
                            </div>

                            <select wire:model="editing.control_type_id" name="editing.control_type_id"
                                    class="mt-2 text-sm pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400">
                                <option value="">-- Choose Control Type --</option>
                                @foreach ($controlTypes as $controlType)
                                    <option value="{{ $controlType->id }}">{{ $controlType->type }}</option>
                                @endforeach
                            </select>
                            @error('editing.control_type_id')<span class="mt-1 text-red-500 text-sm">{{$message}}</span> @enderror
                        </div>
                        <x-input.group for="control-description" inline="true" label="Control Description" :error="$errors->first('editing.control_description')">
                            <x-input.text class="w-full" wire:model="editing.control_description" name="control_description"></x-input.text>
                        </x-input.group>

                        <x-input.group class="mt-4" for="control" inline="true" label="Control" :error="$errors->first('editing.control')">
                            <x-input.tinymce wire:model="editing.control" name="control" />
                        </x-input.group>
                    </div>



                </x-slot>
                <x-slot name="footer">
                    <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                    <x-button.primary type="submit">{{$actionButton}}</x-button.primary>
                </x-slot>
            </x-modal.dialog>
        </form>
    </form>
</div>
