<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Task;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checking because truncate() will fail
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Task::truncate();
        factory(User::class, 10)->create();
        factory(Category::class, 50)->create();
        factory(Task::class, 500)->create();
        // Enable it back
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
