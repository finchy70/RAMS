<div class="max-w-7xl mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Setup
        </h2>
    </x-slot>
    <div class="py-4">
        <form wire:submit="save">
            <x-input.group label="Setup Title" for="setupTitle" :error="$errors->first('setupTitle')">
                <x-input.text wire:model='setupTitle' name="setupTitle" id="setupTitle"/>
            </x-input.group>
            <x-input.group label="Setup" for="setupSetup">
                <x-input.tinymce wire:model="setupSetup" name="setupSetup" />
            </x-input.group>
            <div class="mt-2 row flex justify-end space-x-2">
                <a href="{{route('setup.index')}}" class="py-2 px-4 border rounded-md text-sm leading-5 font-medium focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out border-gray-300 text-gray-700 active:bg-gray-50 active:text-gray-800 hover:text-gray-500">Cancel</a>
                <x-button.primary type="submit">Save</x-button.primary>
            </div>
        </form>
    </div>
</div>


