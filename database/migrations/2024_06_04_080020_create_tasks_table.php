<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() :void
    {
        Schema::dropIfExists('tasks');

        Schema::create('tasks', function (Blueprint $table) {
            $table->id()->comment('タスクID');
            $table->string('task')->comment('タスク');
            $table->Integer('task_status_id')->comment('タスクステータスID');
            $table->Integer('task_scope_id')->comment('タスク公開範囲ID');
            $table->Integer('assigned_user_id')->comment('担当者ID');
            $table->Integer('user_id')->comment('ユーザID');
            $table->timestamps();

            // インデックスの追加
            $table->index('task');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
