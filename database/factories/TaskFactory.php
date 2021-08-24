<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentences(rand(2,4), true),
            'user_id' => User::all()->random()->id,
            'status_id' => Status::all()->random()->id,
            'board_id' => Board::all()->random()->id,
            'created_at' => now(),
        ];
    }
}
