<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'admins';

    protected $guard = ['id']; 
    protected $fillable = [
        'name', 'employee_id', 'salary', 'admin', 'email', 'password', 'facebook_id', 'linkedin_id', 'slug', 'address', 'country', 'phone', 'time_schedule', 'merital', 'gender', 'status', 'employee_img', 'departments', 'dob', 'joining_date', 'shift'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function admin()
    {
        return $this->admin;
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
