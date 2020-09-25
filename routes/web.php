<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('tasks');
});

/**
 * Add a new task
 */
Route::post('/task', function(Request $request) {

    return "You are in: <b>" . route('task') .
        "</b><br>A new task will be here.";

})->name('task');

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
