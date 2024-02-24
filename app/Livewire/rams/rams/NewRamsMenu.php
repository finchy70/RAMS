<?php

namespace App\Livewire\rams\rams;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class NewRamsMenu extends Component
{
    public function mount()
    {
        if(auth()->user()->client_id != 1){
            session()->flash('message', "You are not authorised to perform this action.");
            return redirect(route('dashboard'));
        }
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.rams.new-rams-menu');
    }
}
