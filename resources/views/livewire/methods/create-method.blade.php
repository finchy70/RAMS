<div class="max-w-7xl mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Method
        </h2>
    </x-slot>
    <div class="py-4">
        <form wire:submit="save">
            <x-input.group label="Method Category" for="methodCategoryId" :error="$errors->first('methodCategoryId')">
                <div class="relative mt-2">
                    <select wire:model='methodCategoryId' name="methodCategoryId" id="methodCategoryId" class="w-1/2 border border-gray-200 rounded-lg">
                        <option value='{{null}}' class="block truncate">Please Select a Method Category</option>
                        @foreach($methodCategories as $key=>$methodCategory)
                            <option value="{{$key}}">{{$methodCategory}}</option>
                        @endforeach
                    </select>
                </div>
            </x-input.group>
            <x-input.group label="Method Title" for="methodDescription" :error="$errors->first('methodDescription')">
                <x-input.text wire:model='methodDescription' name="methodDescription" id="methodDescription"/>
            </x-input.group>
            <x-input.group label="Method" for="method" :error="$errors->first('methodMethod')">
                <x-input.tinymce wire:model="methodMethod" name="methodMethod" />
            </x-input.group>
            <div class="mt-2 row flex justify-end space-x-2">
                <a href="{{route('methods.index')}}" class="py-2 px-4 border rounded-md text-sm leading-5 font-medium focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out border-gray-300 text-gray-700 active:bg-gray-50 active:text-gray-800 hover:text-gray-500">Cancel</a>
                <x-button.primary type="submit">Save</x-button.primary>
            </div>
        </form>
    </div>
</div>


