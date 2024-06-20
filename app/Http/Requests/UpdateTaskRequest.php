<?php

namespace App\Http\Requests;

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
                'exists:task_statuses,id'
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
            //'updated_at'  => '更新日時',
        ];
    }
}
