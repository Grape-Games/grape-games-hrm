<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSalaryStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salary_statuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('time_period');
            $table->string('last_increment');
            $table->bigInteger('last_increment_amount');
            $table->string('next_increment');
            $table->bigInteger('increment_amount');
            $table->bigInteger('before_increment');
            $table->enum('status', ['applied', 'not-applied'])->default('not-applied');
            $table->foreignUuid('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('employee_salary_statuses');
    }
}
