<?php

use App\Models\Task;
use Illuminate\Http\Request;
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

/**
 * Display all tasks
 */
Route::view('/', 'tasks');

/**
 * Add a new task
 */
Route::post('/', function(Request $request) {

    $validator = $request->validate([
        'name' => 'required|max:255',
    ]);

    $task = new Task();
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

/**
 * Delete an existing task
 */
Route::delete('/task/{id}', function($id) {

    return "Your are in: <b>" . route('deleteTask') .
        "</b><br>A task will be delete here.";

})->name('deleteTask');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
