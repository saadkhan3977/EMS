<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    protected $table = 'mailbox';
    Protected $guarded = ['id'];


    function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
