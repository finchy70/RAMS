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
    public string $search = "";
    public string $sortField = 'item';
    public string $sortDirection = 'asc';
    public string $actionButton = '';
    public string $item = '';
    public bool $showEditModal = false;
    public Ppe $editing;
    public string $modalTitle;


    public function rules(): array
    {
        if($this->actionButton == 'Save'){
            return [
                'editing.item' => ['required', 'unique:ppes,item'],
            ];
        } else {
            return [
                'editing.item' => ['required', Rule::unique('ppes', 'item')->ignore($this->editing->id)],
            ];
        }

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
            'item' => "",
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
        $this->actionButton = "Update";
        $this->showEditModal = true;
    }

    public function save(): void
    {
        if($this->actionButton == 'Save'){
            $this->validate([
                'editing.item' => ['required', 'unique:ppes,item']
            ]);
        } else {

            $this->validate([
                'editing.item' => ['required', 'unique:ppes,item,' . $this->editing->id],
            ]);
        }

        $this->editing->save();
        $this->makeBlankPpe();
        $this->actionButton = "Save";
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
