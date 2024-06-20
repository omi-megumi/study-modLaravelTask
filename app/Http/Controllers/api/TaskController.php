<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
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
        ]);

        // タスク名、ステータスid、スコープidで絞り込み検索
        if ($request->input('task')) {
            $query->where('task', $request->input('task'));
        }
        if ($request->input('status_id')) {
            $query->where('task_status_id', $request->input('status_id'));
        }
        if ($request->input('scope_id')) {
            $query->where('task_scope_id', $request->input('scope_id'));
        }
        $tasks = $query->get();

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
                'task'             => request()->input('task'),
                'task_status_id'   => request()->input('task_status_id'),
                'task_scope_id'    => request()->input('task_scope_id'),
                'assigned_user_id' => request()->input('assigned_user_id'),
                'user_id'          => request()->input('user_id')
//                'assigned_user_id' => Auth::user()->id,
//                'user_id'          => Auth::user()->id,
            ]);
            if ($task->save()) {
                return $task;
            }

            throw new \Exception('タスクの保存に失敗しました');
        });

        return response()->json([
            'data'    => new TaskResource($storedTask),
            'message' => [
                'title' => 'タスクを追加しました。',
                'body'  => null,
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        info(__METHOD__ . '()#L' . __LINE__);
        logger($task);
        return new TaskResource($task);
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
        $updatedTask = DB::transaction(function () use ($task) {
            $task->fill([
                'task'      => request()->input('task'),
                'status_id' => request()->input('status_id'),
                'scope_id'  => request()->input('scope_id'),
            ]);
            if ($task->save()) {
                return $task;
            }
        });

        return response()->json([
            'data'    => new TaskResource($updatedTask),
            'message' => [
                'title' => 'タスクを更新しました。',
                'body'  => null,
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //echo $task;
        try {
            if ($task->delete()) {
                return response()->json([
                    'result'  => true,
                    'message' => [
                        'title' => 'タスクを削除しました。',
                        'body'  => null
                    ],
                ], 200);
            }
        } catch (\Exception $e) {
            // do nothing
        }
    }
}
