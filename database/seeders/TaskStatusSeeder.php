<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::factory()->create(['name' => '完了']);
        TaskStatus::factory()->create(['name' => '下書き']);
        TaskStatus::factory()->create(['name' => '進行中']);
        TaskStatus::factory()->create(['name' => '保留']);
    }
}
