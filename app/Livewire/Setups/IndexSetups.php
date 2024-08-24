<?php

namespace App\Livewire\Setups;

use App\Models\SetUp;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class IndexSetups extends Component
{
    public bool $all = false;

    use WithPagination;

    public function toggle(): void{
        $this->all = !$this->all;
    }

    public function render(): View|Application|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if($this->all){
            $setups = SetUp::query()->orderBy('title')->paginate(15);
        } else {
            $setups = SetUp::query()->where('user_id', auth()->user()->id)->orderBy('title')->paginate(15);
        }
        return view('livewire.setups.index-setups', compact('setups'));
    }
}
