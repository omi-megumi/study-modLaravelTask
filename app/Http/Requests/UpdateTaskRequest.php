<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'task'             => [
                'required',
                'string',
                'max:255'
            ],
            'task_status_id'   => [
                'required',
                'exists:task_statuses,id',
                // status_id:1(完了) → 他のstatus_idに変更不可
                // status_id:3(進行中) → status_id:2(下書き)に変更不可
                function ($attribute, $newStatus, $fail) {
                    $task = Task::find($this->route('task'));
                    if (!$task) {
                        return;
                    }
                    $currentStatus = Task::find($this->route('task'))->task_status_id;

                    if ($currentStatus === 1 && $newStatus !== 1) {
                        $fail('完了から他のステータスに変更することはできません。');
                    } elseif ($currentStatus === 3 && $newStatus === 2) {
                        $fail('進行中から下書きに変更することはできません。');
                    }
                },
            ],
            'task_scope_id'    => [
                'required',
                'exists:task_scopes,id'
            ],
            'assigned_user_id' => [
                'required',
                'exists:users,id'
            ],
            'user_id'          => [
                'required',
                'exists:users,id'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'task'             => 'タスク',
            'task_status_id'   => 'タスクステータスID',
            'task_scope_id'    => 'タスク公開範囲',
            'assigned_user_id' => '担当者ID',
            'user_id'          => 'ユーザID',
        ];
    }
}
