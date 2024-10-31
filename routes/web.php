<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agents\AgentCongeController;
use App\Http\Controllers\Agents\AgentController;
use App\Http\Controllers\Agents\AgentContactInformationController;
use App\Http\Controllers\Agents\AgentFamilySituationController;

Route::get('/', function () {
    return "";
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


Route::group(['middleware' => 'auth'], function () {

    Route::get('agents', [AgentController::class, 'index'])->name('agents.index');
    Route::get('agents/show/{agent}', [AgentController::class, 'show'])->name('agents.show');
    Route::get('agents/create', [AgentController::class, 'create'])->name('agents.create');
    Route::post('agents/store', [AgentController::class, 'store'])->name('agents.store');
    Route::get('agents/{agent}/edit', [AgentController::class, 'edit'])->name('agents.edit');
    Route::put('agents/{agent}', [AgentController::class, 'update'])->name('agents.update');
    Route::delete('agents/{agent}', [AgentController::class, 'destroy'])->name('agents.destroy');

    Route::get('agents/{agentId}/contact-information/edit', [AgentContactInformationController::class, 'edit'])->name('contact-information.edit');
    Route::post('agents/{agentId}/contact-information/update', [AgentContactInformationController::class, 'update'])->name('contact-information.update');

    Route::get('agents/{agentId}/family-situation/edit', [AgentFamilySituationController::class, 'edit'])->name('family-situation.edit');
    Route::post('agents/{agentId}/family-situation/update', [AgentFamilySituationController::class, 'update'])->name('family-situation.update');


    Route::get('agents/{agent}/conge', [AgentCongeController::class, 'show'])->name('conge.show');
    Route::post('agents/{agent}/conge/init', [AgentCongeController::class, 'init'])->name('conge.init');
    Route::post('agents/{agent}/conge/store', [AgentCongeController::class, 'store'])->name('conge.store');
    Route::get('agents/{agent}/conge/available-balance', [AgentCongeController::class, 'getAvailableBalance']);

});
