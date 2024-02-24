<?php

namespace App\Livewire\dashboard;

use App\Models\Rams;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Livewire\WithPagination;

class UserDashboard extends Component
{
    use WithPagination;

    public function newRams(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        return redirect()->to(route('newRamsMenu'));
    }

    public function edit($id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        return redirect(route('editRams', $id));
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $rams = Rams::query()->where('user_id', auth()->user()->id)->orderBy('job', 'desc')->paginate(15);
        return view('livewire.dashboard.user-dashboard', compact('rams'));
    }
}
