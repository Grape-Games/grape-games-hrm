<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEmployeeSalarySlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_salary_slips', function (Blueprint $table) {
            $table->bigInteger('over_time_hours')->default(0);
            $table->bigInteger('over_time_pay')->default(0);
            $table->bigInteger('over_time_pay_status')->default(false);
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
