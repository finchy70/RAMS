<?php

namespace App\Http\Controllers;

use App\Models\Method;
use Illuminate\Http\Request;

class MethodController extends Controller
{
    public function show($id) {
        $method = Method::query()->findOrFail($id);
        return view('methods.show', ['method' => $method]);
    }
}
