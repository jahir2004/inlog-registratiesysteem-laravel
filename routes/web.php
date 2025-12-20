<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PraktijkmanagementController;
use App\Http\Controllers\TandartsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TesterController;
use App\Http\Controllers\Tandarts2Controller;
use App\Http\Controllers\VoorbeeldController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/tandarts', [TandartsController::class, 'index'])
->name('tandarts.index')
->middleware(['auth', 'role:tandarts,tandarts2']);

Route::get('/admin', [AdminController::class, 'index'])
->name('admin.index')
->middleware(['auth', 'role:admin']);

Route::get('/tester', [TesterController::class, 'index'])
->name('tester.index')
->middleware(['auth', 'role:tester']);

Route::get('/tandarts2', [Tandarts2Controller::class, 'index'])
->name('tandarts2.index')
->middleware(['auth', 'role:tandarts2']);

Route::get('/voorbeeld', [VoorbeeldController::class, 'index'])
->name('voorbeeld.index')
->middleware(['auth', 'role:voorbeeld']);

Route::middleware(['auth', 'role:praktijkmanagement'])->group(function () {
    Route::get('/praktijkmanagement', [PraktijkmanagementController::class, 'index'])
        ->name('praktijkmanagement.index');

    Route::get('/praktijkmanagement/rollen', [PraktijkmanagementController::class, 'manageUserroles'])
        ->name('praktijkmanagement.userroles');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Praktijkmanagement Routes
Route::get('/praktijkmanagement', [PraktijkmanagementController::class, 'index'])
    ->name('praktijkmanagement.index')
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::get('/praktijkmanagement/userroles', [PraktijkmanagementController::class, 'manageUserroles'])
    ->name('praktijkmanagement.userroles')
    ->middleware(['auth', 'role:praktijkmanagement']);

ROUTE::PUT('/praktijkmanagement/{id}', [PraktijkmanagementController::class, 'update'])
    ->name('praktijkmanagement.update')
    ->middleware(['auth', 'role:praktijkmanagement']);

// Alias pad voor directe toegang: /gebruikersrollen
Route::get('/gebruikersrollen', [PraktijkmanagementController::class, 'manageUserroles'])
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::get('/praktijkmanagement/{id}/edit', [PraktijkmanagementController::class, 'edit'])
    ->name('praktijkmanagement.edit')
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::delete('/praktijkmanagement/{id}', [PraktijkmanagementController::class, 'destroy'])
    ->name('praktijkmanagement.destroy')
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::get('/praktijkmanagement/{id}', [PraktijkmanagementController::class, 'show'])
    ->name('praktijkmanagement.show')
    ->middleware(['auth', 'role:praktijkmanagement']);
    
require __DIR__.'/auth.php';
