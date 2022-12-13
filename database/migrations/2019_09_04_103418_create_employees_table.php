<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id', 10);
            $table->string('full_name', 100);
            $table->string('slug', 100);
            $table->string('email', 50);
            $table->string('address', 200);
            $table->string('dob', 20);
            $table->string('phone', 30);
            $table->string('departments', 100);
            $table->string('country');
            $table->string('salary', 20);
            $table->string('time_schedule', 100);
            $table->string('gender', 100);
            $table->string('merital', 100);
            $table->string('shift', 100);
            $table->string('facebook_id', 100);
            $table->string('linkedin_id', 100);
            $table->date('joining_date', 20);
            $table->string('employee_img', 100);
            $table->string('status', 10);
            $table->string('password', 100);
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
        Schema::dropIfExists('employees');
    }
}
