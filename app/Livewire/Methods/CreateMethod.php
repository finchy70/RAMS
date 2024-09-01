<?php

namespace App\Livewire\Methods;

use App\Models\Method;
use App\Models\MethodCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Session;
use function Symfony\Component\String\s;

class CreateMethod extends Component
{
    use WithPagination;

    public string $search = "";
    public string $field = "description";
    public string $sortField = 'description';
    public string $sortDirection = 'asc';
    public bool $showEditModal = false;
    public ?Method $editing = null;
    public string $modalTitle;
    public string $description = '';
    public string $method = '';
    public ?Collection $methodCategories;
    public $catSort;
    public ?int $method_category_id = null;
    public ?int $oldCatId = null;
    public $methodCategory;
    public $oldSearch;
    public $categoryView;


    public function sortBy($field = "description"): void
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function create(): void
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankMethod();
        $this->modalTitle = "Create New Method";
        $this->resetErrorBag();
        $this->showEditModal = true;
    }

    public function edit(Method $method): void
    {
        if ($this->editing->isNot($method)) $this->editing = $method;
        $this->modalTitle = "Edit Method";
        $this->resetErrorBag();
        $this->showEditModal = true;
    }

    public function duplicate(Method $method): void
    {
        $this->editing = new Method;
        $this->editing->description = $method->description . " - copy";
        $this->editing->method = $method->method;
        $this->modalTitle = "Duplicate Method";
        $this->resetErrorBag();
        $this->showEditModal = true;
    }

    public function updatedCategoryView(): void
    {
        $this->search = "";

    }

    public function updatedSearch(): void
    {
        $this->categoryView = null;
    }

    public function save(): void
    {
        $data = $this->validate(
            [
                'description' => ['required'],
                'method_category_id' => 'required',
                'method' => 'required'
            ],
            [
                'editing.method_category_id.required' => 'A Method Category must be selected.'
            ]
        );


        Method::query()->create([
            'user_id' => auth()->user()->id,
            'description' => $data['description'],
            'method_category_id' => $data['method_category_id'],
            'method' => $data['method']
        ]);

        Session::flash('success', 'Method has been created.');
        $this->redirectRoute('methods.index');
    }


    public function getMethodList(): mixed
    {
        if ($this->search == null && $this->categoryView == null) {
            if ($this->oldCatId == $this->categoryView) {
                return $methods = Method::search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->with('category_asc')->paginate(10);
            } else {
                return $methods = Method::search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->with('category_asc')->paginate(10, ['*'], 'page', 1);
            }
        } elseif ($this->search != null) {
            if ($this->categoryView == null) {
                if ($this->oldSearch == $this->search) {
                    return $methods = Method::search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10);
                } else {
                    return $methods = Method::search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10, ['*'], 'page', 1);
                }
            }
        } elseif ($this->categoryView != null) {
            if ($this->search == null) {
                if ($this->oldCatId == $this->categoryView) {
                    return $methods = Method::where('method_category_id', $this->categoryView)->search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10);
                } else {
                    return $methods = Method::where('method_category_id', $this->categoryView)->search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10, ['*'], 'page', 1);
                }
            }
        }
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->methodCategories = MethodCategory::orderBy('category', 'asc')->get();
        $methods = $this->getMethodList();
        $this->oldCatId = $this->categoryView;
        $this->oldSearch = $this->search;
        return view('livewire.methods.create', compact('methods'));
    }
}
