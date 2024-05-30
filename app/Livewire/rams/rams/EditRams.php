<?php

namespace App\Livewire\rams\rams;

use App\Models\Rams;
use Livewire\Component;

class EditRams extends Component
{
    public ?Rams $editRams;

    public function mount(Rams $rams): void
    {
        $this->editRams = $rams;
    }
    public function render()
    {
        return view('livewire.rams.edit-rams');
    }
}
