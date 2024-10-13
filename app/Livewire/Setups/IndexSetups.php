<?php

namespace App\Livewire\Setups;

use App\Models\Setup;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class IndexSetups extends Component
{
    public array $users = [];
    public string $searchTitle = '';
    public string $searchSetup = '';
    public string $searchSelectedUser = '9999';

    use WithPagination;

    public function mount(): void
    {
        $this->users = User::query()->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function newSetup(): void
    {
        $this->redirect(route('setup.create'));
    }

    public function editSetup(Setup $setup): void
    {
        $this->redirect(route('setup.edit', $setup->id));
    }

    public function copySetup(Setup $setup): void
    {
        $newSetup = Setup::query()->create([
            'title' => $setup->title.' - Copy',
            'setup' => $setup->setup,
            'user_id' => auth()->user()->id,
        ]);

        $this->redirect(route('setup.edit', $newSetup->id));
    }


    public function render(): View|Application|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if($this->searchSelectedUser != '9999'){
            $setups = Setup::query()
                ->when('searchTitle', function (Builder $query){
                    return $query->where('title', 'like', '%'.$this->searchTitle.'%');
                })
                ->when('searchSetup', function (Builder $query){
                    return $query->where('setup', 'like', '%'.$this->searchSetup.'%');
                })
                ->where('user_id', $this->searchSelectedUser)
                ->orderBy('title')->with('user')
                ->paginate(15);
        } else {
            $setups = Setup::query()
                ->when('searchTitle', function (Builder $query){
                    return $query->where('title', 'like', '%'.$this->searchTitle.'%');
                })
                ->when('searchSetup', function (Builder $query){
                    return $query->where('setup', 'like', '%'.$this->searchSetup.'%');
                })
                ->orderBy('title')->with('user')
                ->paginate(15);
        }


        return view('livewire.setups.index-setups', compact('setups'));
    }
}
