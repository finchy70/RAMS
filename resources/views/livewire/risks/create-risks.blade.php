<div class="px-4">
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Risk Assessments
            </h2>
        </x-slot>

        <div class="space-y-2">
{{--            <div class="hidden px-2 py-1 bg-green-300 border border-green-500 rounded-md font-bold text-green-800--}}
{{--                        bg-yellow-300 border border-yellow-500 rounded-md font-bold text-yellow-800--}}
{{--                        bg-red-300 border border-red-500 rounded-md font-bold text-red-800"></div>--}}
            <div class="max-w-4xl mx-auto flex justify-between">
                <div class="flex items-center">
                    <x-input.text wire:model.live.debounce.400ms="search" placeholder="Search Operations..."></x-input.text>
                    <x-button.secondary wire:click="clearSearch" class="ml-2 px-1 py-0 text-xs bg-white border border-black hover:text-indigo-400 hover:border-indigo-400 rounded-md">Clear</x-button.secondary>
                </div>

                <x-button.primary wire:click="create" >
                    New Risk
                </x-button.primary>

            </div>

            <div class="py-4">
                @foreach($risks as $risk)
                    <x-risks.risk-table :risk="$risk"></x-risks.risk-table>
                @endforeach
                <div class="max-w-4xl mx-auto">
                    @isset($risks)
                        {{$risks->links()}}
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="save()">
        <x-modal.dialog maxWidth="7xl" wire:model.defer="showEditModal">
            <x-slot name="title">{{ $modalTitle }}</x-slot>
            <x-slot name="content">
                <x-input.group for="operation" inline="true" label="Operation" :error="$errors->first('editing.operation')">
                    <x-input.text class="w-full" wire:model.lazy="editing.operation" name="operation"></x-input.text>
                </x-input.group>
                <x-input.group for="hazard" inline="true" label="Hazard" :error="$errors->first('editing.hazard')">
                    <x-input.text class="w-full" wire:model.lazy="editing.hazard" name="hazard"></x-input.text>
                </x-input.group>

                <x-input.group for="risk" inline="true" label="Risk" :error="$errors->first('editing.risk')">
                    <x-input.text class="w-full" wire:model.lazy="editing.risk" name="risk"></x-input.text>
                </x-input.group>

                <x-input.group for="at_risk" inline="true" label="At Risk" :error="$errors->first('editing.at_risk')">
                    <x-input.text class="w-full" wire:model.lazy="editing.at_risk" name="at_risk"></x-input.text>
                </x-input.group>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="editing.pre_probability">
                        Pre-Controls Probability

                        <select wire:model="editing.pre_probability" name="editing.pre_probability"
                                class="mt-2 text-xs text-gray-700 sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400">
                            <option value="0">-- Choose Rating --</option>
                            <option value="1">1 - Low</option>
                            <option value="2">2 - Low / Medium</option>
                            <option value="3">3 - Medium</option>
                            <option value="4">4 - Medium / High</option>
                            <option value="5">5 - High</option>

                        </select>
                    </label>
                    @error('editing.pre_probability')<span class="mt-1 text-red-500 text-sm">{{$message}}</span> @enderror
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="editing.pre_severity">
                        Pre-Controls Severity
                        <select class="mt-2 text-xs text-gray-700 sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" wire:model="editing.pre_severity" name="editing.pre_severity">
                            <option value="0">-- Choose Rating --</option>
                            <option value="1">1 - Low</option>
                            <option value="2">2 - Low / Medium</option>
                            <option value="3">3 - Medium</option>
                            <option value="4">4 - Medium / High</option>
                            <option value="5">5 - High</option>

                        </select>
                    </label>
                    @error('editing.pre_severity')<span class="mt-1 text-red-500 text-sm">{{$message}}</span> @enderror
                </div>
                <div class="my-2 row flex justify-center">
                    <div class="{{$preRiskFormat}}">{{$preRiskRating}}</div>
                </div>

                <div class="mt-4  border border-gray-600 bg-gray-100 p-2 rounded-lg">
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="ControlType">
                            Control Types
                            <select wire:model="controlType" name="controlType"
                                    class="w-full mt-2 text-sm text-gray-700 sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400">
                                <option value="0">-- Choose Control Type --</option>
                                @foreach($controlTypes as $type)
                                    <option value="{{$type->id}}">{{$type->type}}</option>
                                @endforeach

                            </select>
                        </label>
                        @error('controlType')<span class="mt-1 text-red-500 text-sm">{{$message}}</span> @enderror
                    </div>

                    <div>
                        <label class="mt-1 block font-medium text-sm text-gray-700" for="selectedControl">
                            Controls

                            <select wire:model="selectedControl" name="selectedControl" multiple="multiple" size="10"
                                    class="w-full mt-2 text-xs overflow-y-auto text-gray-700 sm:text-base pl-2 pr-8 rounded-lg border border-gray-400 focus:outline-none focus:border-blue-400">
                                <option disabled value="">-- Choose Control --</option>
                                @foreach($controlsList as $control)
                                    @if(!in_array($control, $selectedControls))
                                        <option value="{{$control['id']}}">
                                            <span class="capitalize">{{$control['control_description']}}</span>
                                        </option>
                                    @endif
                                @endforeach

                            </select>
                        </label>
                        <span class="text-xs text-gray-500 italic">
                            Hold Ctrl to select multiple control measures
                        </span>
                        @error('selectedControls')<span class="mt-1 text-red-500 text-sm">{{$message}}</span> @enderror
                    </div>

                    <div class="row flex justify-end">
                        <x-button.primary wire:click="addToControls" class="px-2 py-1 text-sm border-blue-500 bg-blue-400" type="button">Add</x-button.primary>
                    </div>

                    <div>
                        @if(count($selectedControls) > 0)
                            <div class="block font-medium text-sm text-gray-700">Added Controls</div>
                            @foreach($selectedControls as $control)
                                <div class="row-end-5 flex justify-between items-center px-1 py-1 mb-1 bg-white border border-gray-200 rounded-md text-sm text-gray-700 italic">
                                    <div>{{$control['control']}}</div>
                                    <x-button.secondary class="text-xs bg-red-500 px-1 py-1 text-white hover:bg-red-400 hover:text-white" type="button" wire:click="removeControl({{$loop->iteration-1}})">Delete</x-button.secondary>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <label for="editing.post_probability" class="block font-medium text-sm text-gray-700">
                        Post Controls Probability
                        <select wire:model="editing.post_probability" name="editing.post_probability" id="editing.post_probability"
                                class="mt-2 text-xs text-gray-700 sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400">
                            <option value="0">-- Choose Rating --</option>
                            <option value="1">1 - Low</option>
                            <option value="2">2 - Low / Medium</option>
                            <option value="3">3 - Medium</option>
                            <option value="4">4 - Medium / High</option>
                            <option value="5">5 - High</option>
                        </select>
                    </label>
                    @error('editing.post_probability')<span class="mt-1 text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="editing.post_severity">
                        Post Controls Severity
                        <select wire:model="editing.post_severity" name="editing.post_severity"
                                class="mt-2 text-gray-700 text-xs sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400">
                            <option value="0">-- Choose Rating --</option>
                            <option value="1">1 - Low</option>
                            <option value="2">2 - Low / Medium</option>
                            <option value="3">3 - Medium</option>
                            <option value="4">4 - Medium / High</option>
                            <option value="5">5 - High</option>
                        </select>
                    </label>
                    @error('editing.post_severity')<span class="mt-1 text-red-500 text-sm">{{$message}}</span> @enderror
                </div>
                <div class="my-2 row flex justify-center">
                    <div class="{{$postRiskFormat}}">{{$postRiskRating}}</div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>
