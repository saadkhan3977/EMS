<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    protected $table = 'attendances';

    protected $guard = ['id'];


    protected $fillable = [
        'employee_id', 'employee_name', 'department_name', 'day', 'shift', 'month', 'time_schedule', 'date','time_in','time_out','attendance'
    ];
}
