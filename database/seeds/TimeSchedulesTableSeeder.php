<?php

use Illuminate\Database\Seeder;

class TimeSchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TimeSchedules::class, 3)->create();
    }
}
