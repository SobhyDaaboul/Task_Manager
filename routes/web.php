<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController; // Import the controller

Route::get('/', function () {
    return redirect()->route('tasks.index'); // Redirect root to task list
});

Route::resource('tasks', TaskController::class);
