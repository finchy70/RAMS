<?php

namespace App\Livewire\Methods;

use App\Models\Method;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class IndexMethods extends Component
{
    public bool $all = false;

    use WithPagination;

    public function toggle(): void{
        $this->all = !$this->all;
    }

    public function newMethod(): void
    {
        $this->redirect(route('methods.create'));
    }

    public function editMethod(Method $method): void
    {
        $this->redirect(route('methods.edit', $method));
    }

    public function render(): View|Application|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if($this->all){
            $methods = Method::query()->orderBy('description')->with('methodCategory')->paginate(15);
        } else {
            $methods = Method::query()->where('user_id', auth()->user()->id)->orderBy('description')->with('methodCategory')->paginate(15);
        }
        return view('livewire.methods.index-methods', compact('methods'));
    }
}
