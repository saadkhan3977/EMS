<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id', 10)->nullable();
            $table->string('employee_name', 100)->nullable();
            $table->string('department_name', 100)->nullable();
            // $table->string('day', 100);
            $table->string('month', 100)->nullable();
            $table->string('shift', 100)->nullable();
            $table->string('time_schedule', 100)->nullable();
            $table->string('date', 100)->nullable();
            $table->string('time_in', 100)->nullable();
            $table->string('time_out', 100)->nullable();
            $table->string('attendance', 10)->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
