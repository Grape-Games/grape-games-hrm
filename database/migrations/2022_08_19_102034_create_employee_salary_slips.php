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
            $table->double('per_day')->nullable();
            $table->double('per_hour')->nullable();
            $table->double('per_minute')->nullable();
            $table->double('basic_salary')->nullable();
            $table->double('absents')->nullable();
            $table->double('absent_deduction')->nullable();
            $table->double('half_days')->nullable();
            $table->double('half_day_deduction')->nullable();
            $table->double('late_minutes')->nullable();
            $table->double('late_minutes_deduction')->nullable();
            $table->double('sandwich_rule_deduction')->nullable();
            $table->double('other_deduction');
            $table->double('loan')->nullable();
            $table->double('bouns')->nullable();
            $table->double('totalIncrement')->nullable();
            $table->double('total_salary')->nullable();
            $table->double('tax_deduction')->nullable();
            $table->double('deduction_before_compensation')->nullable();
            $table->double('compensation')->nullable();
            
            $table->double('total_deduction')->nullable();
            $table->double('deduction_after_compensation')->nullable();
            $table->double('approved_salary')->nullable();
            $table->string('dated');
            $table->foreignUuid('employee_id')->constrained();
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('owner_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('employee_salary_slips');
    }
}
