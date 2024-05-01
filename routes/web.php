<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\notepadcontroler;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\NotepadController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\YouTubeController;
use App\Http\Controllers\CommentsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/task', [TaskController::class, 'task'])->name('task.index');



Route::get('/Lansori', [TaskController::class, 'Lansori'])->name('Lansori.index');
Route::get('/Artificial', [TaskController::class, 'Artificial'])->name('Artificial.index');


// Route::post('/delete-data', 'YourController@deleteData');
Route::post('/delete-data', [ProjectController::class, 'deleteData']);

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
Route::get('/Tables/{id}', [TablesController::class, 'Tables'])->name('Tables.index');


// Route::post('/tables', 'TablesController@store')->name('tables.store');
Route::post('/tables', [TablesController::class, 'store']);
Route::delete('/tables/{table}', [TablesController::class, 'destroy']);
Route::patch('/schedule/{schedule}', [TablesController::class, 'update']);

// Route::patch('/schedule/{schedule}', 'ScheduleController@update')->name('schedule.update');
// Route::delete('/tables/{table}', 'TableController@destroy')->name('tables.destroy');
Route::patch('/schedule/{schedule}/update-type', [TablesController::class, 'updateType'])->name('schedule.update-type');



Route::post('/subtasks', [SubtaskController::class, 'store'])->name('subtasks.store');



// إظهار التاسكات الفرعية
Route::get('/subtasks/{taskId}', [SubtaskController::class, 'show'])->name('subtasks.show');

// حذف التاسك الفرعي
Route::delete('/subtasks/{id}', [SubtaskController::class, 'destroy'])->name('subtasks.destroy');

// تحديث حالة التاسك الفرعي
Route::patch('/subtasks/{id}', [SubtaskController::class, 'update'])->name('subtasks.update');



Route::get('/administration/public/files/{scheduleId}', [FileController::class, 'index'])->name('files.index');
Route::post('/administration/public/files', [FileController::class, 'store'])->name('files.store');




// Fetch the main task
// Route::get('/schedule/{scheduleId}', [ScheduleController::class, 'show'])->name('schedule.show');

// Comments-related routes
Route::get('/schedule/{scheduleId}/comments', [CommentsController::class, 'index'])->name('comments.index');
Route::post('/schedule/{scheduleId}/comments', [CommentsController::class, 'store'])->name('comments.store');
Route::delete('/comments/{id}', [CommentsController::class, 'destroy'])->name('comments.destroy');




Route::get('/youtube/playlists', [YouTubeController::class, 'getPlaylists']);
Route::get('/youtube/videos/{playlistId}', [YouTubeController::class, 'getVideos']);

// ========================
Route::get('/Notepad/{id}', [notepadcontroler::class, 'Notepad'])->name('Notepad');


// Route::resource('notepads', NotepadController::class);

// Route::get('/notepads', [NotepadController::class, 'index']);

Route::get('/notepads/show', [NotepadController::class, 'index']);

Route::DELETE('/notepads/destroy/{id}', [NotepadController::class, 'destroy']);

Route::post('/notepads/Save', [NotepadController::class, 'store']);


// routes/web.php
Route::get('/notepads/file/{filename}', [NotepadController::class, 'showFile'])->name('notepads.file.show');

// app/Http/Controllers/NotepadController.php

Route::put('/notepads/update/{id}', [NotepadController::class, 'update']);


Route::get('/', function () {
    return view('copy');
});
