<?php


use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');

    Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');

    Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::patch('/project/{id}', [ProjectController::class, 'update'])->name('projects.update');
//    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});
