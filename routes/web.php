<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/task', [TaskController::class, 'task'])->name('task.index');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::post('/projects', [ProjectController::class, 'store']);
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

Route::get('/mental/{id}', [TaskController::class, 'mental'])->name('mental.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::post('/projects/{project}/tasks', [TaskController::class, 'storeTask'])->name('tasks.store');
Route::delete('/tasks/{task}', [TaskController::class, 'destroyTask'])->name('tasks.destroy');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::post('/tasks/{task}/update-position', [TaskController::class, 'updatePosition'])->name('tasks.update-position');
Route::post('/labels', [TaskController::class, 'storeLabel']);
// ...

Route::delete('/labels/{label}', [TaskController::class, 'destroyLabel'])->name('labels.destroy');
Route::post('/labels/{label}/update-position', [TaskController::class, 'updateLabelPosition'])->name('labels.update-position');


Route::get('/labels/{type}', [TaskController::class, 'getLabelsByType']);
Route::get('/labels/all', [TaskController::class, 'labels']);



// ...
