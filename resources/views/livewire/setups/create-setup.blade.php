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
                    New Setup
                </x-button.primary>
            </div>

            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable wire:click="sortBy('title')" :direction="$sortDirection" class="w-full">Title</x-table.heading>
                    <x-table.heading class="text-right">Options</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($setups as $setup)
                        <x-table.row wire:loading.class.delay="opacity-50">
                            <x-table.cell>
                                {{$setup->title}}
                            </x-table.cell>
                            <x-table.cell class="text-right">
                                <div class="row flex justify-end">
                                    <x-button class="mr-4 !px-2 !py-1 !text-xs" wire:click="duplicate({{$setup->id}})">Copy</x-button>
                                    <x-button class="!px-2 !py-1 !text-xs" wire:click="edit({{$setup->id}})">Edit</x-button>
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
            {{ $setups->links() }}
        </div>
    </div>
    <form wire:submit="save">
        <x-modal.dialog maxWidth="5xl" maxHeight="h-fit" wire:model.defer="showEditModal">
            <x-slot name="title">{{$modalTitle}}</x-slot>
            <x-slot name="content">
                <x-input.group for="title" label="Setup Title" :error="$errors->first('title')">
                    <x-input.text wire:model="editing.title" name="title"></x-input.text>
                </x-input.group>
                <x-input.group for="setup" inline="true" label="Setup Description" :error="$errors->first('setup')">
                    <x-input.tinymce wire:model="editing.setup" name="editing.setup" />
                </x-input.group>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">{{$actionButton}}</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
