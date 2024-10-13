<?php

namespace App\Livewire\Methods;

use App\Models\Method;
use App\Models\MethodCategory;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class IndexMethod extends Component
{
    public array $users = [];
    public array $methodCategories = [];
    public string $searchDescription = '';
    public string $searchMethod = '';
    public string $searchSelectedMethodCategory = '9999';
    public string $searchSelectedUser = '9999';

    use WithPagination;

    public function mount(): void
    {
        $this->users = User::query()->orderBy('name')->pluck('name', 'id')->toArray();
        $this->methodCategories = MethodCategory::query()->orderBy('category')->pluck('category', 'id')->toArray();
    }

    public function newMethod(): void
    {
        $this->redirect(route('methods.create'));
    }

    public function editMethod(Method $method): void
    {
        $this->redirect(route('methods.edit', $method->id));
    }

    public function copyMethod(Method $method): void
    {
        $newMethod = Method::query()->create([
            'description' => $method->description.' - Copy',
            'user_id' => auth()->user()->id,
            'method_category_id' => $method->method_category_id,
            'method' => $method->method,
        ]);

        $this->redirect(route('methods.edit', $newMethod->id));
    }


    public function render(): View|Application|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $methods = Method::query()
            ->when('searchDescription', function (Builder $query) {
                return $query->where('description', 'like', '%'.$this->searchDescription.'%');
            })
            ->when('searchMethod', function (Builder $query) {
                return $query->where('method', 'like', '%'.$this->searchMethod.'%');
            })
            ->when('searchSelectedMethodCategory', function (Builder $query) {
                if($this->searchSelectedMethodCategory != '9999'){
                    return $query->where('method_category_id', $this->searchSelectedMethodCategory);
                } else {
                    return null;
                }
            })
            ->when('searchSelectedUser', function (Builder $query) {
                if ($this->searchSelectedUser != '9999') {
                    return $query->where('user_id', $this->searchSelectedUser);
                } else {
                    return null;
                }
            })
            ->paginate(15);

        return view('livewire.methods.index-method', compact('methods'));
    }
}
