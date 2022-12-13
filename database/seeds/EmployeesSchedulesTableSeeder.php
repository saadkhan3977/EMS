<?php

use Illuminate\Database\Seeder;

class EmployeesSchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\EmployeesSchedules::class, 100)->create();
    }
}
