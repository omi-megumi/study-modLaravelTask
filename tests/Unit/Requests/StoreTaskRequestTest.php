<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\StoreTaskRequest;
use App\Models\TaskScope;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreTaskRequestTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        $this->logInUser = User::factory()->create();
        $this->actingAs($this->logInUser);

        $this->status = TaskStatus::factory()->create();
        $this->scope = TaskScope::factory()->create();
    }

    //有効なサンプルデータを作成して、成功することを確認する。
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
            (new StoreTaskRequest()),
        ])->each(function ($formRequest) use ($data) {
            $validator = Validator::make($data, $formRequest->rules(), [], $formRequest->attributes());
            //echo __METHOD__ . '()#L' . __LINE__ . ':' . json_encode($validator->messages()->messages(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
            $this->assertTrue($validator->passes()); //バリデーションに成功
            $this->assertEquals([], $validator->messages()->messages()); //エラーメッセージが空
        });
    }

    //無効なサンプルデータを作成して、正しいエラーメッセージが返ることを確認する。
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
            (new StoreTaskRequest())->rules(),
            [],
            (new StoreTaskRequest())->attributes()
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
}
