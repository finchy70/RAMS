<?php

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\SetupController;
use App\Livewire\Controls\CreateControl;
use App\Livewire\Dashboard\UserDashboard;
use App\Livewire\Methods\CreateMethod;
use App\Livewire\Methods\EditMethod;
use App\Livewire\Methods\IndexMethod;
use App\Livewire\Ppe\CreatePpe;
use App\Livewire\Prelims\IndexPrelims;
use App\Livewire\Rams\EditRams;
use App\Livewire\Rams\NewRamsMenu;
use App\Livewire\Setups\CreateSetup;
use App\Livewire\Setups\EditSetup;
use App\Livewire\Setups\IndexSetups;
use App\Livewire\Ppe;
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
    Route::get('/setup/create', CreateSetup::class)->name('setup.create');
    Route::get('/setup/{id}/show', [SetupController::class, 'show'])->name('setup.show');
    Route::get('/setup/{setup}/edit', EditSetup::class)->name('setup.edit');
    Route::post('/setup', [SetupController::class, 'store'])->name('setup.store');

    Route::get('/prelims', IndexPrelims::class)->name('prelims.index');

    Route::get('/ppe',CreatePpe::class)->name('ppe.index');

    Route::get('/methods', IndexMethod::class)->name('methods.index');
    Route::get('/methods/create', CreateMethod::class)->name('methods.create');
    Route::get('/methods/{id}/show', [MethodController::class, 'show'])->name('methods.show');
    Route::get('/methods/{method}/edit', EditMethod::class)->name('methods.edit');
    Route::post('/methods', [MethodController::class, 'store'])->name('methods.store');

    Route::get('/controls', CreateControl::class)->name('controls.index');

    Route::get('/risks', [])->name('risks.index');

    Route::get('/data-setup', [])->name('data-setup.index');

    Route::post('/tiny-image-upload', [PictureController::class, 'upload'])->name('picture.upload');
    Route::post('/tiny-image-delete', [PictureController::class, 'delete'])->name('picture.delete');
});



Route::get('/errors/401', [ErrorController::class, 'error401'])->name('errors.401');
