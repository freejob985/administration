<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\taskController;
use App\Http\Controllers\ProjectController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/task', [taskController::class, 'task'])->name('mental.index');

Route::get('/projects', [ProjectController::class, 'task'])->name('tasks.index');
Route::get('/mental', [taskController::class, 'mental'])->name('mental.index');
Route::get('/notebook', [taskController::class, 'notebook'])->name('notebook.index');


Route::post('/projects', [ProjectController::class, 'store']);
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
