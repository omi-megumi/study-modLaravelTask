<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

Route::get('/', function () {
    return view('welcome');
});
//Route::get('api/tasks', [TaskController::class, 'index']);
//Route::post('api/tasks', [TaskController::class, 'store']);
//Route::apiResource('task', TaskController::class);
