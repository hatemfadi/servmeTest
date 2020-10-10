<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Task;

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
        factory(Catgeory::class, 10)->create();
        factory(Task::class, 50)->create();
        // Enable it back
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
