<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('task_name', 100)->nullable();
            $table->string('departments', 100)->nullable();
            $table->string('empployee_id', 100)->nullable();
            $table->string('assign_by', 100)->nullable();
            $table->string('due_date', 100)->nullable();
            $table->string('priority', 100)->nullable();
            $table->string('start_date', 100)->nullable();
            $table->string('status', 100)->nullable();
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
        Schema::dropIfExists('task');
    }
}
