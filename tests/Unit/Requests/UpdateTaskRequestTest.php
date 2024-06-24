<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskScope;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UpdateTaskRequestTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        $this->logInUser = User::factory()->create();
        $this->actingAs($this->logInUser);

//        $this->status = TaskStatus::factory()->create();
//        $this->scope = TaskScope::factory()->create();

        $this->status = TaskStatus::first();
        $this->scope = TaskScope::first();
        $this->task = Task::factory()->create(['user_id' => $this->logInUser->id]);
    }

    public function test_pass()
    {
        $data = [
            'task'             => Str::random(255),
            'task_status_id'   => $this->status->id,
            'task_scope_id'    => $this->scope->id,
            'assigned_user_id' => $this->logInUser->id,
            'user_id'          => $this->logInUser->id,
        ];

        collect([
            (new UpdateTaskRequest()),
        ])->each(function ($formRequest) use ($data) {
            $validator = Validator::make($data, $formRequest->rules(), [], $formRequest->attributes());
            //echo __METHOD__ . '()#L' . __LINE__ . ':' . json_encode($validator->messages()->messages(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
            $this->assertTrue($validator->passes()); //バリデーションに成功
            $this->assertEquals([], $validator->messages()->messages()); //エラーメッセージが空
        });
    }

    public function test_fails(): void
    {
        $data = [
            'task'             => Str::random(256),
            'task_status_id'   => fake()->randomElement([
                '',
                1000
            ]),
            'task_scope_id'    => fake()->randomElement([
                '',
                1000
            ]),
            'assigned_user_id' => fake()->randomElement([
                '',
                1000
            ]),
            'user_id'          => fake()->randomElement([
                '',
                1000
            ]),
        ];
        $validator = Validator::make(
            $data,
            (new UpdateTaskRequest())->rules(),
            [],
            (new UpdateTaskRequest())->attributes()
        );
        $this->assertFalse($validator->passes()); //バリデーションに失敗
        //echo __METHOD__ . '()#L' . __LINE__ . ':' . json_encode($validator->messages()->messages(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
        $this->assertContains(
            Arr::get($validator->messages()->messages(), 'task.0'),
            [
                'タスクの文字数は、255文字以下でなければいけません。',
            ]
        );
        $this->assertContains(
            Arr::get($validator->messages()->messages(), 'task_status_id.0'),
            [
                'タスクステータスIDは必須項目です。',
                '選択されたタスクステータスIDは、有効ではありません。'
            ]
        );
        $this->assertContains(
            Arr::get($validator->messages()->messages(), 'task_scope_id.0'),
            [
                'タスク公開範囲は必須項目です。',
                '選択されたタスク公開範囲は、有効ではありません。'
            ]
        );
        $this->assertContains(
            Arr::get($validator->messages()->messages(), 'assigned_user_id.0'),
            [
                '担当者IDは必須項目です。',
                '選択された担当者IDは、有効ではありません。'
            ]
        );
        $this->assertContains(
            Arr::get($validator->messages()->messages(), 'user_id.0'),
            [
                'ユーザIDは必須項目です。',
                '選択されたユーザIDは、有効ではありません。'
            ]
        );
    }

    //完了(id:1)から他のステータスに変更不可
    public function test_task_status_id_fail_closure_1()
    {
        $this->scope = TaskScope::first();
        $task = Task::factory()->create([
            'task_status_id' => 1,
            'user_id'        => $this->logInUser->id
        ]);

        //フォームリクエストにrouteResolver(リクエストに対応するrouteを返す)をセット
        $request = UpdateTaskRequest::create(
            uri: "api/tasks/{$task->id}",
            method: "POST",
            parameters: [
                'task'             => $task->task,
                'task_status_id'   => 2,
                'task_scope_id'    => $task->task_scope_id,
                'assigned_user_id' => $task->assigned_user_id,
                'user_id'          => $task->user_id,]
        );
        $request->setRouteResolver(fn() => (
        new Route("post", "api/tasks/{$task->id}", [])
        )
            ->bind($request));


        $request->setContainer($this->app)->setRedirector($this->app->make(Redirector::class));
        $errors = [];

        $data = [
            'task'             => Str::random(255),
            'task_status_id'   => fake()->randomElement([2, 3]),
            'task_scope_id'    => $this->scope->id,
            'assigned_user_id' => $this->logInUser->id,
            'user_id'          => $this->logInUser->id,
        ];

        $validator = Validator::make(
            $data,
            (new UpdateTaskRequest())->rules(),
            [],
            (new UpdateTaskRequest())->attributes(),
        );

        try {
            // バリデーション後の結果を取得
            $request->validateResolved();
        } catch (ValidationException $e) {
            $errors = $e->errors();
        }
        $this->assertEquals([], Arr::get($errors, "task_status_id.0"));

//        $this->assertFalse($validator->passes()); //バリデーションに失敗する
////        echo __METHOD__ . '()#L' . __LINE__ . ':' . json_encode($validator->messages()->messages(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
//        $this->assertContains(
//            Arr::get($validator->messages()->messages(), 'task_status_id.0'),
//            [
//                '完了から他のステータスに変更することはできません。'
//            ]
//        );
    }

//    // 進行中(id:3)から下書き(id:2)に変更不可のテスト
//    public function test_task_status_id_fail_closure_2()
//    {
//        $this->scope = TaskScope::first();
//        $this->task = Task::factory()->create([
//            'task_status_id' => 3,
//            'user_id' => $this->logInUser->id
//        ]);
//
//        $data = [
//            'task'             => Str::random(255),
//            'task_status_id'   => 2,
//            'task_scope_id'    => $this->scope->id,
//            'assigned_user_id' => $this->logInUser->id,
//            'user_id'          => $this->logInUser->id,
//        ];
//        $validator = Validator::make(
//            $data,
//            (new UpdateTaskRequest())->rules(),
//            [],
//            (new UpdateTaskRequest())->attributes(),
//        );
//        $this->assertFalse($validator->passes());
//        echo __METHOD__ . '()#L' . __LINE__ . ':' . json_encode($validator->messages()->messages(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
//        $this->assertContains(
//            Arr::get($validator->messages()->messages(), 'task_status_id.0'),
//            [
//                '進行中から下書きに変更することはできません。'
//            ]
//        );
//    }
}
