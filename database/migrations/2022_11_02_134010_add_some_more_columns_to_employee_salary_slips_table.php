<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeMoreColumnsToEmployeeSalarySlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_salary_slips', function (Blueprint $table) {
            $table->double('per_hour')->nullable();
            $table->double('per_minute')->nullable();
            $table->double('absents')->nullable();
            $table->double('absent_deduction')->nullable();
            $table->double('half_day_deduction')->nullable();
            $table->double('sandwich_rule_deduction')->nullable();
            $table->double('other_deduction');
            $table->double('bouns')->nullable();
            $table->double('totalIncrement')->nullable();
            $table->double('total_salary')->nullable();
            $table->double('tax_deduction')->nullable();
            $table->double('deduction_before_compensation')->nullable();
            $table->double('compensation')->nullable();
            $table->double('total_deduction')->nullable();
            $table->double('deduction_after_compensation')->nullable();
            $table->double('approved_salary')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_salary_slips', function (Blueprint $table) {
            //
        });
    }
}
