<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatusSeeder::class,
        ]);

        User::factory()
            ->count(5)
            ->has(
                Board::factory()
                    ->count(1)
                    ->has(Task::factory()->count(4))
            )
            ->create();

        foreach (Board::all() as $board){
//            $board::factory()->has(Task::factory()->count(3));
        }
    }
}
