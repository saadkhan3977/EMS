<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaves extends Model
{
    protected $table = 'leaves';
    Protected $guarded = ['id'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'employee_id');
    }
}
