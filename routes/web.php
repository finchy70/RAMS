<?php

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\PictureController;
use App\Livewire\Dashboard\UserDashboard;
use App\Livewire\Methods\CreateMethod;
use App\Livewire\Methods\IndexMethods;
use App\Livewire\Prelims\IndexPrelims;
use App\Livewire\Rams\EditRams;
use App\Livewire\Rams\NewRamsMenu;
use App\Livewire\Setups\IndexSetups;
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
    config('jetstream.auth_session')
])->group(function () {
    Route::get('/', UserDashboard::class)->name('dashboard');

    Route::get('/new-rams-menu', NewRamsMenu::class)->name('newRamsMenu');

    Route::get('/rams-create', [])->name('rams.create');
    Route::get('/edit-rams/{rams}', EditRams::class)->name('editRams');

    Route::get('/setup', IndexSetups::class)->name('setup.index');

    Route::get('/prelims', IndexPrelims::class)->name('prelims.index');

    Route::get('/ppe', [])->name('ppe.index');

    Route::get('/methods', IndexMethods::class)->name('methods.index');
    Route::get('/methods-create', CreateMethod::class)->name('methods.create');
    Route::get('/methods/show/{id}', [MethodController::class, 'show'])->name('methods.show');

    Route::get('/controls', [])->name('controls.index');

    Route::get('/risks', [])->name('risks.index');

    Route::get('/data-setup', [])->name('data-setup.index');
});

Route::post('/upload', [PictureController::class, 'upload'])->name('picture.upload');

Route::get('/errors/401', [ErrorController::class, 'error401'])->name('errors.401');
