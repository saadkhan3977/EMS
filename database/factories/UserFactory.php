<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Users;
use App\Attendances;
use App\Employees;
use App\Departments;
use App\TimeSchedules;
use App\Shifts;
use App\Leaves;
use App\BreakTimes;

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Users::class, function (Faker $faker) {

    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'employee_id' => $faker->numberBetween($min = 1, $max = 100),
        'admin' =>0,
        'email_verified_at' => now(),
        'password' => $password ?: $password = bcrypt('12345678'), // password
        'remember_token' => Str::random(10),


        'country' => $faker->country,
        'slug' => str::slug($faker->name),
        'departments' => $faker->jobTitle,
        'address' => $faker->address,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'salary' => $faker->randomElement(array('20000','40000', '80000', '100000')),
        'phone' => $faker->phoneNumber,
        'time_schedule' => $faker->randomElement(array('(09 a.m) to (05 p.m)','(03 p.m) to (11 p.m)')),
        'shift' => $faker->randomElement(array('Morning','Night', 'Evening')),
        'gender' => $faker->randomElement(array('Male','Female', 'Others')),
        'merital' => $faker->randomElement(array('Married','Unmarried')),
        'facebook_id' => $faker->freeEmail,
        'linkedin_id' => $faker->freeEmail,
        'joining_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'employee_img' => 'No image found',
        'status' => $faker->randomElement(array('DEACTIVE','ACTIVE')),
    ];
});


/* EMPLOYEE FACTORY */
$factory->define(App\Employees::class, function (Faker $faker) {
    static $password;
    $Name = $faker->name;
    return [
        'employee_id' => $faker->numberBetween($min = 1, $max = 100),
        'full_name' => $Name,
        'slug' => str::slug($Name),
        'departments' => $faker->jobTitle,
        'address' => $faker->address,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'country' => $faker->country,
        'salary' => $faker->randomElement(array('20000','40000', '80000', '100000')),
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'time_schedule' => $faker->randomElement(array('(09 a.m) to (05 p.m)','(03 p.m) to (11 p.m)')),
        'shift' => $faker->randomElement(array('Morning','Night', 'Evening')),
        'gender' => $faker->randomElement(array('Male','Female', 'Others')),
        'merital' => $faker->randomElement(array('Married','Unmarried')),
        'facebook_id' => $faker->freeEmail,
        'linkedin_id' => $faker->freeEmail,
        'joining_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'employee_img' => 'No image found',
        'status' => $faker->randomElement(array('DEACTIVE','ACTIVE')),
        'password' => $password ?: $password = bcrypt('hello123')

    ];
});


/* ATTENDANCE FACTORY */

$factory->define(Attendances::class, function (Faker $faker) {
    return [
        'employee_id' => $faker->numberBetween($min = 1, $max = 100),
        'employee_name' => $faker->name,
        // 'day' => $faker->dayOfWeek($max = 'now'),
        'month' => $faker->monthName($max = 'now'),

        'shift' => $faker->randomElement(array('Morning','evening')),
        'time_schedule' => $faker->randomElement(array('(09 a.m) to (05 p.m)','(03 p.m) to (11 p.m)')),
        'department_name' => $faker->randomElement(array('Web Development','Graphics Designer','SEO', 'Web Designer', 'App Developer')),
        'date' => $faker->date,
        'time_in' => $faker->randomElement(array('09 AM','10 AM','11 AM')),
        'time_out' => $faker->randomElement(array('05 PM','06 PM','07 PM')),
        'attendance' => $faker->randomElement(array('PRESENT','ABSENT'))
    ];
});

/* DEPARTMENTS FACTORY */

$factory->define(Departments::class, function (Faker $faker) {
    return [
        'departments' => $faker->randomElement(array('Web Development','Graphics Designer','SEO', 'Web Designer', 'App Developer')),
        'status' => $faker->randomElement(array('DEACTIVE','ACTIVE'))
    ];
});


/* DEPARTMENTS FACTORY */

$factory->define(Shifts::class, function (Faker $faker) {
    return [
        'shifts' => $faker->randomElement(array('Morning','Evening','Night')),
        'status' => $faker->randomElement(array('DEACTIVE','ACTIVE'))
    ];
});


/* TIME SCHEDULES FACTORY */

$factory->define(TimeSchedules::class, function (Faker $faker) {
    return [
        'time_schedule' => $faker->randomElement(array('(09 a.m) to (05 p.m)', '(12 p.m) to (08 p.m)', '(03 p.m) to (11 p.m)')),
        'status' => $faker->randomElement(array('DEACTIVE','ACTIVE'))
    ];
});

/* LEAVES FACTORY */

$factory->define(Leaves::class, function (Faker $faker) {
    return [
        'employee_id' => $faker->numberBetween($min = 1, $max = 100),
        'leave_type' => $faker->randomElement(array('Sick', 'Permanent Issues', 'Tour', 'Marriage')),
        'duration' => $faker->randomElement(array('Half Day', '1 Day', '1 week', '3 Days')),
        'name' => $faker->name,
        'department' => $faker->jobTitle,
        'document_img' => 'No document img found',
        'reason' => $faker->paragraph,
        'status' => $faker->randomElement(array('REJECTED','APPROVED','PENDING'))
    ];
});


/* TIME SCHEDULES FACTORY */

$factory->define(BreakTimes::class, function (Faker $faker) {
    return [
        'break_time' => $faker->randomElement(array('(12 p.m) to (01 p.m)', '(01 p.m) to (02 p.m)', '(07 p.m) to (08 p.m)')),
        'status' => $faker->randomElement(array('DEACTIVE','ACTIVE'))
    ];
});



/*  COUNTRY FACTORY */

/*$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => $faker->country  
    ];
});
*/
/* STATE FACTORY */

/*$factory->define(State::class, function (Faker $faker) {
    return [
        'name' => $faker->state  
    ];
});*/

/* STATE FACTORY */

/*$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->city  
    ];
});*/