<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpoloyeeSalarySlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salary_slips', function (Blueprint $table) {
            $table->id();
            $table->string("per_day")->nullable();
            $table->string("basic_salary")->nullable();
            $table->string("salaried_days")->nullable();
            $table->string("leaves")->nullable();
            $table->string("days_deduction")->nullable();
            $table->string("late_minutes")->nullable();
            $table->string("late_minutes_deduction")->nullable();
            $table->string("net_salary")->nullable();
            $table->string("deduction_compensated")->nullable();
            $table->string("advance")->nullable();
            $table->string("loan")->nullable();
            $table->string("electricity")->nullable();
            $table->string("income_tax")->nullable();
            $table->string("dated");
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
        Schema::dropIfExists('empoloyee_salary_slips');
    }
}
