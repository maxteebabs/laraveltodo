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
        // Task::truncate();
        $faker = \Faker\Factory::create();
        factory(Task::class, 10)->create();
    }
}
