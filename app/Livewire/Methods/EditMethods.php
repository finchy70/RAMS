<?php

namespace App\Livewire\Methods;

use App\Models\Method;
use Livewire\Component;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class EditMethods extends Component
{
    public Method $method;

    public function mount(Method $method): void{
        $this->method = $method;
    }

    public function render()
    {
        return view('livewire.methods.edit-methods', ['method' => $this->method]);
    }
}
