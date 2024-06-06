<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task' => $this->faker->sentence,
            'task_status_id' => $this->faker->numberBetween(1, 3),
            'task_scope_id' => $this->faker->numberBetween(1, 3),
            'assigned_user_id' => $this->faker->numberBetween(1, 3),
            'user_id' => $this->faker->numberBetween(1, 3),
            //'deleted_at' => null

        ];
    }
}
