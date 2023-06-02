<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSalarySlips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salary_slips', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('per_day')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('salaried_days')->nullable();
            $table->string('leaves')->nullable();
            $table->string('days_deduction')->nullable();
            $table->double('late_minutes')->nullable();
            $table->double('late_minutes_deduction')->nullable();
            $table->double('net_salary')->nullable();
            $table->double('deduction_compensated')->nullable();
            $table->double('advance')->nullable();
            $table->double('loan')->nullable();
            $table->string('electricity');
            $table->string('income_tax');
            $table->string('dated');
            $table->double('half_days')->nullable();
            $table->foreignUuid('employee_id')->constrained();
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('owner_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->bigInteger('over_time_hours')->default(0);
            $table->bigInteger('over_time_pay')->default(0);
            $table->bigInteger('over_time_pay_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_salary_slips');
    }
}
