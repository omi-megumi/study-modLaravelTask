<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

Route::get('/', function () {
    return view('welcome');
});
//Route::get('api/tasks', [TaskController::class, 'index']);
//Route::post('api/tasks', [TaskController::class, 'store']);
//Route::get('api/tasks/{task}', [TaskController::class, 'show']);
//Route::put('api/tasks/{id}', [TaskController::class, 'update']);
//Route::delete('api/tasks/{id}', [TaskController::class, 'destroy']);
