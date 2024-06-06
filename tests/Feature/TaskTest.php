<?php
namespace Tests\Feature;

use App\Models\TaskScope;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    //use DatabaseTransactions;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // ユーザーを作成し、ログインする
        $user = User::factory()->create();
        $this->be($user);
    }

    /*
     * タスク表示のテスト
     * 0：サンプルデータを作成する
     * 1：/tasksにアクセスする
     * 2：ページが表示される
     * 3：0で作成したタスク一覧が表示される
     */

    public function test_index()
    {

        $task = Task::factory()->create();
        $taskScope = TaskScope::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->getJson(
            Str::of("/api/tasks")
                ->append("?status_id={$task->task_status_id}")
                ->append("&scope_id={$task->task_scope_id}")
        )

         ->tap(function (TestResponse $response) {
          echo json_encode($response->json(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . PHP_EOL;
         });

        $response->assertJson(fn(AssertableJson $json) => $json
            ->has('data', null, fn(AssertableJson $json) => $json
                ->whereAllType([
                    'id' => 'integer',
                    'task' => 'string',
                    'task_status_id' => 'integer',
                    'task_scope_id' => 'integer',
                    'user_id' => 'integer',
                    'created_at' => 'string',
                    'updated_at' => 'string',
                    'deleted_at' => 'null',
                    'task_scope.id' => 'integer',
                    'task_scope.name' => 'string',
                    'task_scope.created_at' => 'string',
                    'task_scope.updated_at' => 'string',
                    'task_status.id' => 'integer',
                    'task_status.name' => 'string',
                    'task_status.created_at' => 'string',
                    'task_status.updated_at' => 'string',
                    'user.id' => 'integer',
                    'user.name' => 'string',
                    'user.email' => 'string',
                    'user.email_verified_at' => 'string',
                    'user.created_at' => 'string',
                    'user.updated_at' => 'string',
                    'user.deleted_at' => 'null'
                ])
            )
        );
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
