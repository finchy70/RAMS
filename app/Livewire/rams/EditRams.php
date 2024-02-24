<?php

namespace App\Livewire\rams;

use App\Models\Rams;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class EditRams extends Component
{
    public function mount(Rams $ram): void
    {
        dd($ram);
    }
    public function render()
    {
        return view('livewire.rams.edit-rams');
    }
}
