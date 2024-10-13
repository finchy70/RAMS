<?php

namespace App\Livewire\Controls;

use App\Models\Control;
use App\Models\ControlType;
use App\Models\Method;
use App\Models\MethodCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateControl extends Component
{
    public Control $editing;
    public string $search = "";
    public string $oldSearch;
    public $controlView;
    public $oldCatId;
    public $field = "control";
    public $sortField = "control";
    public $sortDirection = "asc";
    public $showEditModal = false;
    public $showViewModal = false;
    public ?Control $showControl = null;
    public $modalTitle;


    public function rules()
    {
        return [
            'editing.control_description' => ['required', Rule::unique('controls', 'control_description')->ignore($this->editing->id)],
            'editing.control_type_id' => 'required',
            'editing.control' => 'required'
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankControl();
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankControl();
        $this->modalTitle = "Create New Control";
        $this->resetErrorBag();
        $this->showEditModal = true;
    }

    public function edit(Control $control)
    {
        if ($this->editing->isNot($control)) $this->editing = $control;
        $this->modalTitle = "Edit Control";
        $this->resetErrorBag();
        $this->showEditModal = true;
    }

    public function duplicate(Control $control)
    {
        $this->editing = new Control;
        $this->editing->control_description = $control->control_description . " - copy";
        $this->editing->control = $control->control;
        $this->modalTitle = "Duplicate Control";
        $this->resetErrorBag();
        $this->showEditModal = true;
    }

    public function sortBy($field = "control")
    {
        if ($this->sortField = $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function makeBlankControl(): Control
    {
        return Control::query()->make([
            'control_description' => " ",
            'control_type_id' => " ",
            'control' => " "]);
    }

    public function save(): void
    {
        $this->validate();
        $this->editing->save();
        $this->makeBlankControl();
        $this->showEditModal = false;
    }

    public function getControlList(): LengthAwarePaginator
    {
        if ($this->search == null && $this->controlView == null) {
            if ($this->oldCatId == $this->controlView) {
                return $controls = Control::query()->search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->with('type_asc')->paginate(10);
            } else {
                return $controls = Control::query()->search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->with('type_asc')->paginate(10, ['*'], 'page', 1);
            }
        } elseif ($this->search != null) {
            if ($this->controlView == null) {
                if ($this->oldSearch == $this->search) {
                    return $controls = Control::query()->search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10);
                } else {
                    return $controls = Control::query()->search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10, ['*'], 'page', 1);
                }
            }
        } elseif ($this->controlView != null) {
            if ($this->search == null) {
                if ($this->oldCatId == $this->controlView) {
                    return $controls = Control::query()->where('control_type_id', $this->controlView)->search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10);
                } else {
                    return $controls = Control::query()->where('control_type_id', $this->controlView)->search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10, ['*'], 'page', 1);
                }
            }
        }
    }

    public function view(Control $control): void
    {
        $this ->showViewModal = true;
        $this->showControl = $control;
    }

    public function render()
    {
        $control_types = ControlType::query()->orderBy('type', 'asc')->get();
        $controls = $this->getControlList();
        $this->oldCatId = $this->controlView;
        $this->oldSearch = $this->search;
        return view('livewire.controls.create-control', compact('controls', 'control_types'));
    }
}
