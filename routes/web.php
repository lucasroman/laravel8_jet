<?php


use App\Http\Controllers\TaskController; // Required by Task controller
use Illuminate\Support\Facades\Route; // Only by default

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Show task form and tasks list
Route::get('/', [TaskController::class, 'index']);

// Add a new task
Route::post('/', [TaskController::class, 'store']);

// Delete an existing task
Route::delete('/{task}', [TaskController::class, 'destroy'])
->name('task.delete');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
