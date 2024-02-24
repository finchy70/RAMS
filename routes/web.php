<?php

use App\Livewire\dashboard\UserDashboard;
use App\Livewire\Rams\EditRams;
use App\Livewire\rams\rams\NewRamsMenu;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', UserDashboard::class)->name('dashboard');

    Route::get('/new-rams-menu', NewRamsMenu::class)->name('newRamsMenu');

    Route::get('/rams-create', [])->name('rams.create');
    Route::get('/edit-rams/{rams}', EditRams::class)->name('editRams');

    Route::get('/setup', [])->name('setup.index');

    Route::get('/prelims', [])->name('prelims.index');

    Route::get('/ppe', [])->name('ppe.index');

    Route::get('/methods', [])->name('methods.index');

    Route::get('/controls', [])->name('controls.index');

    Route::get('/risks', [])->name('risks.index');

    Route::get('/data-setup', [])->name('data-setup.index');
});
