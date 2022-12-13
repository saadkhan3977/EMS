<?php

use Illuminate\Database\Seeder;

class BreakTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\BreakTimes::class, 5)->create();
    }
}
