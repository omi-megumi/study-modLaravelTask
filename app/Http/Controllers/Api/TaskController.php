<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::with([
            'taskScope',
            'taskStatus',
            'user',
            'assignedUser'
        ])
            ->when($request->input('task'), fn($query, $task) => $query->where('task', $task))
            ->when($request->input('status_id'), fn($query, $status_id) => $query->where('task_status_id', $status_id))
            ->when($request->input('scope_id'), fn($query, $scope_id) => $query->where('task_scope_id', $scope_id));

        $tasks = $query->get();
        return Taskresource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $storedTask = DB::transaction(function () {
            $task = new Task([
                'task'             => request()->input('task'),
                'task_status_id'   => request()->input('task_status_id'),
                'task_scope_id'    => request()->input('task_scope_id'),
                'assigned_user_id' => request()->input('assigned_user_id'),
                'user_id'          => request()->input('user_id')
            ]);
            $task->save();
            return $task;
        });

        return TaskResource::make($storedTask);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        info(__METHOD__ . '()#L' . __LINE__);
        logger($task);
        return TaskResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $updatedTask = DB::transaction(function () use ($task) {
            $task->fill([
                'task'           => request()->input('task'),
                'task_status_id' => request()->input('task_status_id'),
                'scope_id'       => request()->input('scope_id'),
            ]);
            $task->save();
            return $task;
        });

        return TaskResource::make($updatedTask);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }
}
