<?php

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
        $this->call(UsersTableSeeder::class);
        // $this->call(AttendancesTableSeeder::class);
        // $this->call(EmployeesTableSeeder::class);
        // $this->call(DepartmentsTableSeeder::class);
        // $this->call(TimeSchedulesTableSeeder::class);
        // $this->call(ShiftsTableSeeder::class);
        // $this->call(LeavesTableSeeder::class);
        // $this->call(BreakTimesTableSeeder::class);
    }
}
