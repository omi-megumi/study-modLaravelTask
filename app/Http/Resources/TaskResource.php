<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray($request)
    {
        return [
            'id'               => $this->id,
//            'task'             => $this->task,
//            'task_status_id'   => $this->task_status_id,
//            'task_scope_id'    => $this->task_scope_id,
//            'assigned_user_id' => $this->assigned_user_id,
//            'user_id'          => $this->user_id,
//            'created_at'       => $this->created_at,
//            'updated_at'       => $this->updated_at,
//            'deleted_at'       => $this->deleted_at,
//            'task_scope'       => [
//                'id'         => $this->taskScope->id,
//                'name'       => $this->taskScope->name,
//                'created_at' => $this->taskScope->created_at,
//                'updated_at' => $this->taskScope->updated_at,
//            ],
//            'task_status'      => [
//                'id'         => $this->taskStatus->id,
//                'name'       => $this->taskStatus->name,
//                'created_at' => $this->taskStatus->created_at,
//                'updated_at' => $this->taskStatus->updated_at,
//            ],
//            'user'             => [
//                'id'                  => $this->user->id,
//                'name'                => $this->user->name,
//                'email'               => $this->user->email,
//                'email_verified_at'  => $this->user->email_verified_at,
//                'created_at'          => $this->user->created_at,
//                'updated_at'          => $this->user->updated_at,
//                'deleted_at'          => $this->user->deleted_at,
//            ],
//            'assigned_user'    => [
//                'id'                  => $this->assignedUser->id,
//                'name'                => $this->assignedUser->name,
//                'email'               => $this->assignedUser->email,
//                'email_verified_at'  => $this->assignedUser->email_verified_at,
//                'created_at'          => $this->assignedUser->created_at,
//                'updated_at'          => $this->assignedUser->updated_at,
//                'deleted_at'          => $this->assignedUser->deleted_at,
//            ],
        ];
    }

}
