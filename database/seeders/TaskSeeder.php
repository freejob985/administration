<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $tasks = [
        ['name' => 'Task 1', 'project_id' => 1, 'completed' => false],
        ['name' => 'Task 2', 'project_id' => 1, 'completed' => true],
        ['name' => 'Task 3', 'project_id' => 2, 'completed' => false],
        ['name' => 'Task 4', 'project_id' => 3, 'completed' => true],
    ];

    foreach ($tasks as $task) {
        \App\Models\Task::create($task);
    }
    }
}
