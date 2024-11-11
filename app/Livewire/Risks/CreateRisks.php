<?php

namespace App\Livewire\Risks;

use App\Models\Control;
use App\Models\ControlType;
use App\Models\Risk;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;


class CreateRisks extends Component
{
    use WithPagination;

    public $search = "";
    public $sortField = 'operation';
    public $sortDirection = 'asc';
    public $preRiskRating;
    public $preRiskFormat = "";
    public $postRiskRating;
    public $postRiskFormat = "";
    public $showEditModal = false;
    public Risk $editing;
    public $modalTitle;
    public $controlType;
    public $controlTypes;
    public $selectedControls = [];
    public $selectedControl = [];
    public $controlsList = [];
    public $controls;


    public function rules()
    {
        return [
            'editing.operation' => ['required',Rule::unique('risks', 'operation')->ignore($this->editing->id)],
            'editing.hazard' => 'required',
            'editing.risk' => 'required',
            'editing.at_risk' => 'required',
            'editing.pre_probability' => 'required|numeric|max:5|min:1',
            'editing.post_probability' => 'required|numeric|max:5|min:1',
            'editing.pre_severity' => 'required|numeric|max:5|min:1',
            'editing.post_severity' => 'required|numeric|max:5|min:1',
            'selectedControls' => 'required|array'
        ];
    }

    public function makeBlankRisk()
    {
        return Risk::make([
            'editing.operation' => '',
            'editing.hazard' => '',
            'editing.risk' => '',
            'editing.at_risk' => '',
            'editing.pre_probability' => '',
            'editing.post_probability' => '',
            'editing.pre_severity' => '',
            'editing.post_severity' => '',
        ]);
    }

    public function mount(): void
    {
        $this->editing = $this->makeBlankRisk();
        $this->controlTypes = ControlType::orderBy('type', 'asc')->get();
        $this->controls = Control::select('id', 'control')->orderBy('control', 'asc')->get()->toArray();
    }

    public function create(): void
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankRisk();
        $this->modalTitle = "Create New Risk";
        $this->showEditModal = true;
    }

    public function updatedControlType(): void
    {
        $this->controlsList = Control::select('id', 'control_description')->where('control_type_id', $this->controlType)->orderBy('control', 'asc')->get()->toArray();
    }

    public function updatedEditingPreSeverity(): void
    {
        $this->preRiskRating = $this->editing->pre_severity * $this->editing->pre_probability;
        if($this->preRiskRating > 0)
        {
            $this->preRiskFormat = $this->getRiskFormat($this->preRiskRating);
        }
    }

    public function updatedEditingPreProbability(): void
    {

        $this->preRiskRating = $this->editing->pre_severity * $this->editing->pre_probability;
        if($this->preRiskRating > 0)
        {
            $this->preRiskFormat = $this->getRiskFormat($this->preRiskRating);
        }
    }

    public function updatedEditingPostSeverity(): void
    {
        $this->postRiskRating = $this->editing->post_severity * $this->editing->post_probability;
        if($this->postRiskRating > 0)
        {
            $this->postRiskFormat = $this->getRiskFormat($this->postRiskRating);
        }
    }

    public function updatedEditingPostProbability(): void
    {

        $this->postRiskRating = $this->editing->post_severity * $this->editing->post_probability;
        if($this->postRiskRating > 0)
        {
            $this->postRiskFormat = $this->getRiskFormat($this->postRiskRating);
        }
    }

    public function addToControls(): void
    {
        if(!empty($this->selectedControl)){
            for($i = 0; $i < count($this->selectedControl); $i++)
            {
                $added_control = $this->controls[array_search($this->selectedControl[$i], array_column($this->controls, 'id'))];

                if(!in_array($added_control, $this->selectedControls))
                {
                    $this->selectedControls[] = $added_control;
                }
            }
            $this->selectedControl =null;
        }
    }

    public function removeControl($index): void
    {
        unset($this->selectedControls[$index]);
        $this->selectedControls = array_values($this->selectedControls);
    }


    public function save(): void
    {
        $this->validate();
        $this->editing->save();
        foreach($this->selectedControls as $control)
        {
            $this->editing->controls()->attach($control['id']);
        }
        $this->makeBlankRisk();
        $this->controlType = "";
        $this->selectedControls = [];
        $this->showEditModal = false;
        $this->search = $this->editing->operation;
    }

    public function clearSearch(): void
    {
        $this->search = "";
    }

    private function getRiskFormat($rating): string
    {
        if($rating < 6)
        {
            return "px-2 py-1 bg-green-300 border border-green-500 rounded-md font-bold text-green-800";
        }
        elseif($rating < 15)
        {
            return "px-2 py-1 bg-yellow-300 border border-yellow-500 rounded-md font-bold text-yellow-800";
        }
        else
        {
            return "px-2 py-1 bg-red-300 border border-red-500 rounded-md font-bold text-red-800";
        }
    }

    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        $risks = Risk::query()->search($this->sortField, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10);
        return view('livewire.risks.create-risks' ,[
            'risks' => $risks
        ]);
    }
}
