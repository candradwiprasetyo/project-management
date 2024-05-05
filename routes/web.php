<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::get('/projects/{projectId}/tasks', [TaskController::class, 'index'])->name('projects.tasks.index');
Route::get('/projects/{projectId}/tasks/create', [TaskController::class, 'create'])->name('projects.tasks.create');
Route::post('/projects/{projectId}/tasks', [TaskController::class, 'store'])->name('projects.tasks.store');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');

