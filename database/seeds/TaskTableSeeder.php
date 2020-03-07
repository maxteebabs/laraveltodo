<?php

use Illuminate\Database\Seeder;
use App\Domain\Tasks\Task;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            Task::create([
                'title' => $faker->sentence,
                'note' => $faker->paragraph,
                'is_completed' => 0,
                'tags' => 'My Day',
            ]);
        }
    }
}
