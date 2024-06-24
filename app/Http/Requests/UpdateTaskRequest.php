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
                function ($attribute, $newStatus, $fail) {
                    info('$attribute ' . $attribute);
                    info('$newStatus ' . $newStatus);
                    info('all ' . json_encode($this->all()));
                    info('route' . $this->route('task_status_id'));

                    // 現在のタスクステータスIDを取得
                    $currentStatus = $this->route('task')->task_status_id;

                    if ($currentStatus === 1 && $newStatus !== 1) {
                        // 完了(1)から他のステータスに変更不可
                        $fail('完了から他のステータスに変更することはできません。');
                    } elseif ($currentStatus === 3 && $newStatus === 2) {
                        // 進行中(3)から下書き(2)に変更不可
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

    /*
     * 完了(1)から他のステータスに変更不可
     * 進行中(3)から下書き(2)に変更不可
     */
    public function validateStatusChange($newStatus)
    {
        info(__METHOD__ . '()#L' . __LINE__);
        $currentStatus = $this->route('task')->task_status_id;

        if ($currentStatus === 1 && $newStatus !== 1){
            return '完了から他のステータスに変更することはできません。';
        } elseif ($currentStatus === 3 && $newStatus === 2){
            return '進行中から下書きに変更することはできません。';
        }
    }
}
