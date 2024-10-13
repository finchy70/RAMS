<?php

namespace App\Livewire\Setups;

use App\Models\Method;
use App\Models\MethodCategory;
use App\Models\SetUp;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Session;
use function Symfony\Component\String\s;

class CreateSetup extends Component
{
    use WithPagination;

    public string $setupTitle = '';
    public string $setupSetup = '';

    public function save(): void
    {
        $data = $this->validate(
            [
                'setupTitle' => ['required'],
                'setupSetup' => 'required',

            ],
        );

        Setup::query()->create([
            'user_id' => auth()->user()->id,
            'title' => $data['setupTitle'],
            'setup' => $data['setupSetup'],
        ]);

        Session::flash('success', 'Setup has been created.');
        $this->redirectRoute('setup.index');
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.setups.create-setup');
    }
}
