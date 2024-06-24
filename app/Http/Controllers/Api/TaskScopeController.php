<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskScopeRequest;
use App\Http\Requests\UpdateTaskScopeRequest;
use App\Models\TaskScope;

class TaskScopeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreTaskScopeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskScope $taskScope)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskScope $taskScope)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskScopeRequest $request, TaskScope $taskScope)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskScope $taskScope)
    {
        //
    }
}
