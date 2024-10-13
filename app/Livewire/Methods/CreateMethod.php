<?php

namespace App\Livewire\Methods;

use App\Models\Method;
use App\Models\MethodCategory;
use App\Models\SetUp;
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

    public array $methodCategories = [];
    public string $methodDescription = '';
    public string $methodMethod = '';
    public ?int $methodCategoryId = null;

    public function mount(): void
    {
        $this->methodCategories = MethodCategory::query()->orderBy('category')->pluck('category', 'id')->toArray();
    }
    public function save(): void
    {
        $data = $this->validate(
            [
                'methodCategoryId' => ['required'],
                'methodDescription' => ['required'],
                'methodMethod' => ['required']
                ]
                ,
                [
                    'methodCategoryId.required' => 'You must select a Method Category.',
                    'methodDescription.required' => 'You must enter a Method Description.',
                    'methodMethod.required' => 'You must enter a Method.'
                ]
        );

        Method::query()->create([
            'user_id' => auth()->user()->id,
            'description' => $data['methodDescription'],
            'method' => $data['methodMethod'],
            'method_category_id' => $data['methodCategoryId']
        ]);

        Session::flash('success', 'Method has been created.');
        $this->redirectRoute('methods.index');
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $methods = $this->methodCategories;
        return view('livewire.methods.create-method', compact('methods'));
    }
}
