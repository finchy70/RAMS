<?php

namespace App\Livewire\Prelims;

use App\Models\Prelim;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPrelims extends Component
{
    public bool $all = false;

    use WithPagination;

    public function toggle(): void{
        $this->all = !$this->all;
    }

    public function render(): View|Application|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if($this->all){
            $prelims = Prelim::query()->orderBy('created_at', 'desc')->paginate(15);
        } else {
            $prelims = Prelim::query()->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(15);
        }
        return view('livewire.prelims.index-prelims', compact('prelims'));
    }
}
