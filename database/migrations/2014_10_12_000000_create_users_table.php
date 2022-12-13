<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('salary')->nullable();
            $table->string('employee_id', 10)->nullable();
            $table->string('admin')->default(0);
            $table->timestamp('email_verified_at');
            
            
            $table->string('slug')->nullable();
            $table->string('country')->nullable();

            $table->string('address', 200)->nullable();
            $table->string('dob', 20)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('departments', 100)->nullable();
            $table->string('time_schedule', 100)->nullable();
            $table->string('gender', 100)->nullable();
            $table->string('merital', 100)->nullable();
            $table->string('shift', 100)->nullable();
            $table->string('facebook_id', 100)->nullable();
            $table->string('linkedin_id', 100)->nullable();
            $table->string('joining_date', 20)->nullable();
            $table->string('employee_img', 100)->nullable();
            $table->string('status', 10)->nullable();
            $table->string('role', 100)->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
