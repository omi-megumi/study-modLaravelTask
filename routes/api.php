<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;


// ログイン済みのユーザに制限する
Route::middleware(['auth'])->group(function () {
    Route::apiResource('tasks', TaskController::class);
});
