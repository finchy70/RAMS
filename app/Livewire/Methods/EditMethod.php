<?php

namespace App\Livewire\Methods;

use App\Models\Method;
use App\Models\MethodCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Session;

class EditMethod extends Component
{
    public Method $method;
    public $methodCategories;
    public string $methodCategoryId = '';
    public string $methodDescription = '';
    public string $methodMethod = '';

    public function mount(Method $method): void{
        $this->method = $method;
        $this->methodCategoryId = $method->method_category_id;
        $this->methodDescription = $method->description;
        $this->methodMethod = $method->method;

    }

    public function update(): void
    {
        $data = $this->validate(
            [
                'methodDescription' => ['required'],
                'methodCategoryId' => 'required',
                'methodMethod' => 'required'
            ],
            [
                'method_category_id.required' => 'A Method Category must be selected.'
            ]
        );

        $this->method->update([
            'user_id' => auth()->user()->id,
            'description' => $data['methodDescription'],
            'method_category_id' => $data['methodCategoryId'],
            'method' => $data['methodMethod']
        ]);

        Session::flash('success', 'Method has been updated.');
        $this->redirectRoute('methods.index');
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->methodCategories = MethodCategory::query()->orderBy('category', 'asc')->get();
        return view('livewire.methods.edit-method', ['method' => $this->method]);
    }
}
