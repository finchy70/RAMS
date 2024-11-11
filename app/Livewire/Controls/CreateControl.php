<?php

namespace App\Livewire\Controls;

use App\Models\Client;
use App\Models\Control;
use App\Models\ControlType;
use App\Models\SetUp;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class CreateControl extends Component
{
    use WithPagination;

    public string $search = "";
    public string $sortField = 'control_description';
    public string $sortDirection = 'asc';
    public string $title = '';
    public bool $showEditModal = false;
    public Control $editing;
    public string $modalTitle = '';
    public string $actionButton = '';

    public Collection $controlTypes;


    public function rules(): array
    {
        return [
            'editing.control_description' => 'required',
            'editing.control' => 'required',
            'editing.control_type_id' => 'required',
            'editing.user_id' => 'required'
        ];
    }

    public function sortBy($field = "title"): void
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function makeBlankControl(): Control
    {
        return Control::query()->make([
            'control_type_id' => '',
            'control_description' => "",
            'control' => "",
            'user_id' => ""
        ]);
    }

    public function mount(): void
    {
        $this->editing = $this->makeBlankControl();
    }

    public function create(): void
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankControl();
        $this->modalTitle = "Create New Control";
        $this->actionButton = 'Save';
        $this->showEditModal = true;
    }

    public function edit(Control $control): void
    {
        if ($this->editing->isNot($control)) $this->editing = $control;
        $this->modalTitle = "Edit Control";
        $this->showEditModal = true;
        $this->actionButton = 'Update';
    }

    public function duplicate(Control $control): void
    {
        $this->editing = new Control();
        $this->editing->control_type_id = $control->control_type_id;
        $this->editing->title = $control->control_description." - copy";
        $this->editing->setup = $control->control;
        $this->editing->user_id = auth()->user()->id;
        $this->actionButton = 'Save Copy';
        $this->modalTitle = "Duplicate Control";
        $this->showEditModal = true;
    }

    public function save(): void
    {
        $this->validate();
        $this->editing->save();
        $this->makeBlankControl();
        $this->showEditModal = false;
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->controlTypes = ControlType::query()->orderBy('type')->get();
        $controlsList = Control::query()->search('control_description', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10);
        return view('livewire.controls.create-control', [
            'controls' => $controlsList
        ]);
    }
}
