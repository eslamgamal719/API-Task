<?php

use App\User;
use App\Worker;
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
         $this->call(DatabaseMonthsSeeder::class);

        $users = 3;
        $workers = 10;

        factory(User::class, $users)->create();
        factory(Worker::class, $workers)->create();
    }
}
