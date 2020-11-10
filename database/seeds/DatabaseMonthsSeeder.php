<?php

use App\Month;

use Illuminate\Database\Seeder;

class DatabaseMonthsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $array = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for($i = 0; $i < 12; $i++) {

            Month::create([
                'month' => $array[$i],
                'salaries_total' => 20000,
                'bonus_total' => 2000,
                'payments_total' => 22000
            ]);
        }
    }
}
