<?php
namespace Tests\Feature;

use App\Models\TaskScope;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    /*
     * タスク表示のテスト
     * 0：サンプルデータを作成する
     * 1：/tasksにアクセスする
     * 2：ページが表示される
     * 3：0で作成したタスク一覧が表示される
     */
    public function test_index(){
        $taskScope = TaskScope::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $user = User::factory()->create();

        $task = Task::factory()->create([
            'task_scope_id' => $taskScope->id,
            'task_status_id' => $taskStatus->id,
            'user_id' => $user->id,
        ]);

        $response = $this->get('api/tasks');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [[
                'id',
                'task',
                'task_status_id',
                'task_scope_id',
                'user_id',
                'created_at',
                'updated_at',
                'deleted_at',
                'task_scope' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                ],
                'task_status' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                ],
                'user' => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]]
        ]);

//        $response->assertJson([
//            'data' => [[
//                'id' => $task->id,
//                'task' => $task->task,
//                'task_status_id' => $task->task_status_id,
//                'task_scope_id' => $task->task_scope_id,
//                'user_id' => $task->user_id,
//                'created_at' => $task->created_at,
//                'updated_at' => $task->updated_at,
//                'deleted_at' => null,
//                'task_scope' => [
//                    'id' => $taskScope->id,
//                    'name' => $taskScope->name,
//                    'created_at' => $taskScope->created_at,
//                    'updated_at' => $taskScope->updated_at,
//                ],
//                'task_status' => [
//                    'id' => $taskStatus->id,
//                    'name' => $taskStatus->name,
//                    'created_at' => $taskStatus->created_at,
//                    'updated_at' => $taskStatus->updated_at,
//                ],
//                'user' => [
//                    'id' => $user->id,
//                    'name' => $user->name,
//                    'email' => $user->email,
//                    'email_verified_at' => $user->email_verified_at,
//                    'created_at' => $user->created_at,
//                    'updated_at' => $user->updated_at,
//                    'deleted_at' => null,
//                ]
//            ]]
//        ]);
    }

    /* タスク登録のテスト
     * 1：/newにアクセスする
     * 2：ページが表示される
     * 3：サンプルデータを入力する
     * 4：保存する
     * 5：自動的に/tasksにアクセスする
     * 6：3で入力したタスクが表示される
    */

}
