<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskDetail extends Model
{
    protected $table = 'task_detail';
    protected $guarded = ['id'];
    // protected $fillable = ['filename','task_id'];
}
