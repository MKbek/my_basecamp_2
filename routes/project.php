<?php


use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TopicsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');

    Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');

    Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::patch('/project/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::post('/project/{id}/invite', [ProjectController::class, 'invite'])->name('project.invite');
    Route::post('/project/{id}/leave', [ProjectController::class, 'leave'])->name('project.leave');
    Route::post('/project/{id}/user/{uid}', [ProjectController::class, 'delete'])->name('project.delete');

    Route::post('/project/{id}/topic/store', [TopicsController::class, 'store'])->name('topic.store');
    Route::get('/topic/{id}/edit', [TopicsController::class, 'edit'])->name('topic.edit');
    Route::patch('/topic/{id}', [TopicsController::class, 'update'])->name('topic.update');
    Route::delete('/topic/{id}', [TopicsController::class, 'destroy'])->name('topic.destroy');

    Route::post('/topic/{id}/message', [TopicsController::class, 'message'])->name('topic.message');
    Route::get('/topic/{id}/message/{mid}/edit', [TopicsController::class, 'editMessage'])->name('topic.message.edit');
    Route::patch('/topic/{id}/message/{mid}', [TopicsController::class, 'updateMessage'])->name('topic.message.update');
    Route::delete('/topic/{id}/message/{mid}/delete', [TopicsController::class, 'deleteMessage'])->name('topic.message.delete');

    Route::post('/project/{id}/attachment', [AttachmentController::class, 'store'])->name('attachment.store');
    Route::delete('/project/{id}/attachment/{fid}', [AttachmentController::class, 'destroy'])->name('attachment.destroy');
});
