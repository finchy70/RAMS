<div class="max-w-7xl mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Method
        </h2>
    </x-slot>
    <div class="py-4">
        <form method="post" action="{{ route('methods.create') }}">
            <x-input.group label="Method Category" for="method_category_id" :error="$errors->first('method_category_id')">
                <div class="relative mt-2">
                    <select wire:model='method_category_id' name="method_category_id" id="method_category_id" class="w-1/2 border border-gray-200 rounded-lg">
                        <option value='{{null}}' class="block truncate">Please Select a Method Category</option>
                        @foreach($methodCategories as $methodCategory)
                            <option value="{{$methodCategory->id}}">{{$methodCategory->category}}</option>
                        @endforeach
                    </select>
                </div>
            </x-input.group>
            <x-input.group label="Method Title" for="description" :error="$errors->first('description')">
                <x-input.text wire:model='description' name="description" id="description"/>
            </x-input.group>
{{--            <x-input.group label="Create Method" for="method" :error="$errors->first('method')">--}}
{{--                <x-input.rich-text wire:model="method" name="method" id="method"></x-input.rich-text>--}}
{{--            </x-input.group>--}}

                <x-forms.tinymce-editor name="method" />

            <div class="mt-2 row flex justify-end">
                <x-button.primary type="submit">Save</x-button.primary>
            </div>
        </form>
    </div>
</div>


