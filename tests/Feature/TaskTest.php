<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    protected $loggedInUser;

    protected function setUp(): void
    {
        parent::setUp();

        // ユーザーを作成し、ログインする
        $this->logInUser = User::factory()->create();
        $this->actingAs($this->logInUser);
    }

    public function test_index()
    {
        $assignedUser = User::factory()->create();
        $task = Task::factory()->create([
            'assigned_user_id' => $assignedUser->id,
            'user_id'          => $this->logInUser->id
        ]);

        $this->getJson(
            str("/api/tasks")
                ->append("?status_id={$task->task_status_id}")
                ->append("&scope_id={$task->task_scope_id}")
        )
            ->tap(function (TestResponse $response) {
                //echo json_encode($response->json(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . PHP_EOL;
            })
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('data', null, self::typeClosure()) // 型チェック
            );
    }

    public function test_store()
    {
        $assignedUser = User::factory()->create();
        $task = Task::factory()->make([
            'assigned_user_id' => $assignedUser->id,
            'user_id'          => $this->logInUser->id
        ]);

        $this->postJson("/api/tasks", [
            'task'             => $task->task,
            'task_status_id'   => $task->task_status_id,
            'task_scope_id'    => $task->task_scope_id,
            'assigned_user_id' => $task->assigned_user_id,
            'user_id'          => $task->user_id,
        ])
            ->tap(function (TestResponse $response) {
                echo json_encode($response->json(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . PHP_EOL;
            })
            ->assertSuccessful()
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('data', self::typeClosure())
                ->where('message.title', 'タスクを追加しました。')
                ->where('message.body', null)
            );
    }

    public function test_show()
    {
        $assignedUser = User::factory()->create();
        $task = Task::factory()->create([
            'assigned_user_id' => $assignedUser->id,
            'user_id'          => $this->logInUser->id
        ]);
        $this->getJson("api/tasks/{$task->id}")
            ->tap(function (TestResponse $response) {
                //echo json_encode($response->json(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . PHP_EOL;
            })
            ->assertSuccessful()
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('data', self::typeClosure())
            );
    }

    public function test_update()
    {
        $assignedUser = User::factory()->create();
        $task = Task::factory()->create([
            'assigned_user_id' => $assignedUser->id,
            'user_id'          => $this->logInUser->id
        ]);

        $this->putJson("/api/tasks/{$task->id}", [
            'task'             => $task->task,
            'task_status_id'   => $task->task_status_id,
            'task_scope_id'    => $task->task_scope_id,
            'assigned_user_id' => $task->assigned_user_id,
            'user_id'          => $task->user_id,
        ])
            ->tap(function (TestResponse $response) {
                //echo json_encode($response->json(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . PHP_EOL;
            })
            ->assertSuccessful()
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('data', self::typeClosure())
                ->where('message.title', 'タスクを更新しました。')
                ->where('message.body', null)
            );
    }

    public function test_destroy()
    {
        $assignedUser = User::factory()->create();
        $task = Task::factory()->create([
            'assigned_user_id' => $assignedUser->id,
            'user_id'          => $this->logInUser->id
        ]);

        $this->deleteJson("/api/tasks/{$task->id}")
            ->assertSuccessful()
            ->assertJson(fn(AssertableJson $json) => $json
                ->where('result', true)
                ->where('message.title', 'タスクを削除しました。')
                ->where('message.body', null)
            );
    }

    //型チェック
    public static function typeClosure()
    {
        return fn(AssertableJson $json) => $json
            ->whereAllType([
                'id'                              => 'integer',
                'task'                            => 'string',
                'task_status_id'                  => 'integer',
                'task_scope_id'                   => 'integer',
                'assigned_user_id'                => 'integer',
                'user_id'                         => 'integer',
                'created_at'                      => 'string',
                'updated_at'                      => 'string',
                'deleted_at'                      => 'null',
                'task_scope.id'                   => 'integer',
                'task_scope.name'                 => 'string',
                'task_scope.created_at'           => 'string',
                'task_scope.updated_at'           => 'string',
                'task_status.id'                  => 'integer',
                'task_status.name'                => 'string',
                'task_status.created_at'          => 'string',
                'task_status.updated_at'          => 'string',
                'user.id'                         => 'integer',
                'user.name'                       => 'string',
                'user.email'                      => 'string',
                'user.email_verified_at'          => 'string',
                'user.created_at'                 => 'string',
                'user.updated_at'                 => 'string',
                'user.deleted_at'                 => 'null',
                'assigned_user'                   => 'array',
                'assigned_user.id'                => 'integer',
                'assigned_user.name'              => 'string',
                'assigned_user.email'             => 'string',
                'assigned_user.email_verified_at' => 'string',
                'assigned_user.created_at'        => 'string',
                'assigned_user.updated_at'        => 'string',
                'assigned_user.deleted_at'        => 'null'
            ]);
    }
}
