<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::with(['taskScope', 'taskStatus', 'user', 'assignedUser'])->get();

        $tasks = $tasks->map(function ($task) {
            $assignedUser = User::find($task->assigned_user_id);
            $task->assigned_user = $assignedUser;
            return $task;
        });

        //return response()->json(['data' => $tasks]);
        return new TaskCollection($tasks);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $storedTask = DB::transaction(function () {
            $task = new Task([
                'task' => request()->input('task'),
                'task_status_id' => request()->input('task_status_id'),
                'task_scope_id' => request()->input('task_scope_id'),
                'assigned_user_id' => request()->input('assigned_user_id'),
                'user_id' => request()->input('user_id')
            ]);
            if ($task->save()) {
                return $task;
            }
        });
        return (new TaskResource($storedTask))->setMessage('タスクを追加しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
