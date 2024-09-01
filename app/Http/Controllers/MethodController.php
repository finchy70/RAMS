<?php

namespace App\Http\Controllers;

use App\Models\Method;
use App\Models\MethodCategory;
use Illuminate\Http\Request;
use Session;

class MethodController extends Controller
{
    public function create()
    {
        $methodCategories = MethodCategory::orderBy('category', 'asc')->get();
        return view('methods.create', ['methodCategories' =>$methodCategories]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => ['required'],
            'method_category_id' => 'required',
            'method' => 'required'
        ]);

        Method::query()->create([
            'user_id' => auth()->user()->id,
            'description' => $data['description'],
            'method_category_id' => $data['method_category_id'],
            'method' => $data['method']
        ]);

        Session::flash('success', 'Method has been created.');
        return redirect(route('methods.index'));

    }
    public function show($id) {
        $method = Method::query()->findOrFail($id);
        return view('methods.show', ['method' => $method]);
    }
}
