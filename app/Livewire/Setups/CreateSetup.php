<?php

namespace App\Livewire\Setups;

use App\Models\Client;
use App\Models\SetUp;
use Livewire\Component;
use Livewire\WithPagination;

class CreateSetup extends Component
{
    use WithPagination;

    public string $search = "";
    public string $sortField = 'title';
    public string $sortDirection = 'asc';
    public string $title = '';
    public bool $showEditModal = false;
    public SetUp $editing;
    public string $modalTitle = '';
    public string $actionButton = '';


    public function rules(): array
    {
        return [
            'editing.title' => 'required',
            'editing.setup' => 'required',
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

    public function makeBlankSetup(): SetUp
    {
        return SetUp::make([
            'title' => " ",
            'setup' => " ",
            'user_id' => ""]);
    }

    public function mount(): void
    {
        $this->editing = $this->makeBlankSetup();
    }

    public function create(): void
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankSetup();
        $this->modalTitle = "Create New Setup";
        $this->actionButton = 'Save';
        $this->showEditModal = true;
    }

    public function edit(SetUp $setup): void
    {
        if ($this->editing->isNot($setup)) $this->editing = $setup;
        $this->modalTitle = "Edit Setup";
        $this->showEditModal = true;
        $this->actionButton = 'Update';
    }

    public function duplicate(Setup $setup): void
    {
        $this->editing = new Setup;
        $this->editing->title = $setup->title." - copy";
        $this->editing->setup = $setup->setup;
        $this->editing->user_id = auth()->user()->id;
        $this->actionButton = 'Save Copy';
        $this->modalTitle = "Duplicate Setup";
        $this->showEditModal = true;
    }

    public function save(): void
    {
        $this->validate();
        $this->editing->save();
        $this->makeBlankSetup();
        $this->showEditModal = false;
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $setupList = SetUp::search('title', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10);
        return view('livewire.setups.create-setup', [
            'setups' => $setupList
        ]);
    }
}
