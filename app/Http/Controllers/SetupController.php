<?php

namespace App\Http\Controllers;

use App\Models\Method;
use App\Models\SetUp;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function show($id) {
        $setup = Setup::query()->findOrFail($id);
        return view('setup.show', ['setup' => $setup]);
    }
}
