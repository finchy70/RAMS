<?php

namespace App\Livewire\rams\rams;

use App\Models\Method;
use App\Models\Ppe;
use App\Models\Prelim;
use App\Models\SetUp;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class NewRamsMenu extends Component
{
    public ?int $prelimId = null;
    public ?int $setupId = null;
    public ?int $methodId = null;
    public bool $showPrelimButton = false;
    public bool $showSetupButton = false;
    public bool $showMethodButton = false;
    public bool $showModal = false;
    public String $title = "";
    public String $content = "";

    public function mount()
    {
        if(auth()->user()->client_id != 1){
            session()->flash('message', "You are not authorised to perform this action.");
            return redirect(route('dashboard'));
        }
    }

    public function updatedPrelimId($id): void
    {
        if($id == null) {
            $this->showPrelimButton = false;
        } else {
            $this->showPrelimButton = true;
        }
    }

    public function updatedSetupId($id): void
    {
        if($id == null) {
            $this->showSetupButton = false;
        } else {
            $this->showSetupButton = true;
        }
    }

    public function updatedMethodId($id): void
    {
        if($id == null) {
            $this->showMethodButton = false;
        } else {
            $this->showMethodButton = true;
        }
    }

    public function showPrelim($id): void
    {
        $prelim = Prelim::query()->where('id', $id)->first();
        $this->title = "Prelim - ".$prelim->title;
        $this->content = $prelim->prelims;
        $this->showModal = true;
    }

    public function showSetup($id): void
    {
        $setup = Setup::query()->where('id', $id)->first();
        $this->title = "Setup - ".$setup->title;
        $this->content = $setup->setup;
        $this->showModal = true;
    }

    public function showMethod($id): void
    {
        $method = Method::query()->where('id', $id)->first();
        $this->title = "Method - ".$method->description;
        $this->content = $method->method;
        $this->showModal = true;
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $prelims = Prelim::query()->orderBy('title')->get();
        $setups = SetUp::query()->orderBy('title')->get();
        $methods = Method::query()->orderBy('description')->get();
        return view('livewire.rams.new-rams-menu', [
            'prelims' => $prelims,
            'setups' => $setups,
            'methods' => $methods
        ]);
    }
}
