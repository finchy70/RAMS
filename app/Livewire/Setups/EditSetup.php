<?php

namespace App\Livewire\Setups;

use App\Models\Method;
use App\Models\MethodCategory;
use App\Models\SetUp;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Session;

class EditSetup extends Component
{
    public Setup $setup;
    public $setupTitle;
    public string $setupSetup = '';
    public string $setupUser = '';


    public function mount(Setup $setup): void{
        $this->setup = $setup;
        $this->setupTitle = $setup->title;
        $this->setupSetup = $setup->setup;

    }

    public function update(): void
    {
        $data = $this->validate(
            [
                'setupTitle' => ['required'],
                'setupSetup' => 'required',
            ],

        );

        $this->setup->update([
            'user_id' => auth()->user()->id,
            'title' => $data['setupTitle'],
            'setup' => $data['setupSetup'],
        ]);

        Session::flash('success', 'Setup has been updated.');
        $this->redirectRoute('setup.index');
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.setups.edit-setup');
    }
}
