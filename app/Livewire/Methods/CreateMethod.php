<?php

namespace App\Livewire\Methods;

use App\Models\Method;
use App\Models\MethodCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
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
    public Collection $categories;

    public ?int $oldCatId = null;
    public string $oldSearch = "";
    public ?int $categoryView = null;
    public string $actionButton = "";


    public function rules(): array
    {
        return [
            'editing.description' => ['required', Rule::unique('methods', 'description')->ignore($this->editing->id)],
            'editing.method_category_id' => 'required',
            'editing.method' => 'required',
            'editing.user_id' => 'required',
        ];
    }

    public function sortBy($field = "description"): void
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function makeBlankMethod(): Method
    {
        return Method::make([
            'description' => " ",
            'method_category_id' => " ",
            'method' => " ",
            'user_id' => auth()->user()->id]);
    }

    public function mount(): void
    {
        $this->editing = $this->makeBlankMethod();
    }

    public function create(): void
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankMethod();
        $this->modalTitle = "Create New Method";
        $this->resetErrorBag();
        $this->actionButton = 'Save';
        $this->showEditModal = true;
    }

    public function edit(Method $method): void
    {
        if ($this->editing->isNot($method)) $this->editing = $method;
        $this->modalTitle = "Edit Method";
        $this->actionButton = 'Update';
        $this->resetErrorBag();
        $this->showEditModal = true;
    }

    public function duplicate(Method $method): void
    {
        $this->editing = new Method;
        $this->editing->description = $method->description . " - copy";
        $this->editing->method = $method->method;
        $this->editing->method_category_id = $method->method_category_id;
        $this->editing->user_id = auth()->user()->id;
        $this->modalTitle = "Duplicate Method";
        $this->actionButton = 'Save Copy';
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
        $this->validate();
        $this->editing->save();
        $this->makeBlankMethod();
        $this->showEditModal = false;
    }

    public function getMethodList(): LengthAwarePaginator|null
    {
        if ($this->search == null && $this->categoryView == null) {
            if ($this->oldCatId == $this->categoryView) {
                return Method::search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->with('category_asc')->paginate(10);
            } else {
                return Method::search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->with('category_asc')->paginate(10, ['*'], 'page', 1);
            }
        } elseif ($this->search != null) {
            if ($this->categoryView == null) {
                if ($this->oldSearch == $this->search) {
                    return Method::search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10);
                } else {
                    return Method::search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10, ['*'], 'page', 1);
                }
            }
        } elseif ($this->categoryView != null) {
            if ($this->oldCatId == $this->categoryView) {
                return Method::where('method_category_id', $this->categoryView)->search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10);
            } else {
                return Method::where('method_category_id', $this->categoryView)->search($this->field, $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10, ['*'], 'page', 1);
            }
        }
        return null;
    }

    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        $this->categories = MethodCategory::orderBy('category', 'asc')->get();
        $methods = $this->getMethodList();
        $this->oldCatId = $this->categoryView;
        $this->oldSearch = $this->search;
        return view('livewire.methods.create-method', compact('methods'));
    }
}
