<?php

namespace Database\Seeders;

use App\Models\TaskScope;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskScopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskScope::factory()->create(['name' => '公開']);
        TaskScope::factory()->create(['name' => '非公開']);
    }
}
