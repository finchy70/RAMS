<?php

namespace App\Livewire\Ppe;

use App\Models\Ppe;
use App\Models\Prelim;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Session;

class CreatePpe extends Component
{
    use WithPagination;
    public $search = "";
    public $sortField = 'item';
    public $sortDirection = 'asc';
    public $item;
    public $showEditModal = false;
    public Ppe $editing;
    public $modalTitle;


    public function rules(): array
    {
        return [
            'editing.item' => ['required', Rule::unique('ppes', 'item')->ignore($this->editing->id)],
        ];
    }

    public function sortBy($field = "item"): void
    {
        if ($this->sortField = $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
    }

    public function makeBlankPpe()
    {
        return Ppe::make([
            'item' => ""
        ]);
    }

    public function mount(): void
    {
        $this->editing = $this->makeBlankPpe();
    }

    public function create(): void
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankPpe();
        $this->modalTitle = "Create New PPE";
        $this->showEditModal = true;
    }

    public function edit(Ppe $ppe): void
    {
        if ($this->editing->isNot($ppe)) $this->editing = $ppe;
        $this->modalTitle = "Edit PPE";
        $this->showEditModal = true;
    }

    public function save(): void
    {
        $this->validate(
            ['editing.item' => ['required']]
        );
        $this->editing->save();
        $this->makeBlankPpe();
        $this->showEditModal = false;
        Session::flash("success", "PPE has been updated!");
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $ppes = Ppe::query()->search('item', $this->search)->orderBy('item', $this->sortDirection)->paginate(10);
        return view('livewire.ppe.create-ppe', [
            'ppes' => $ppes
        ]);
    }
}
