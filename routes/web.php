<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/agents', [AgentController::class, 'index'])->name('agents.index');
Route::get('/agents/create', [AgentController::class, 'create'])->name('agents.create');
Route::post('/agents/store', [AgentController::class, 'store'])->name('agents.store');
Route::get('/agents/{agent}/edit', [AgentController::class, 'edit'])->name('agents.edit');
Route::put('/agents/{agent}', [AgentController::class, 'update'])->name('agents.update');
Route::delete('/agents/{agent}', [AgentController::class, 'destroy'])->name('agents.destroy');
