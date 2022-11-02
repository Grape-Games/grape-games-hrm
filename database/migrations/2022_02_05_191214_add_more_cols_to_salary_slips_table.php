<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColsToSalarySlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salary_slips', function (Blueprint $table) {
            $table->integer('total_days')->nullable();
            $table->integer('present_days')->nullable();
            $table->integer('absent_days')->nullable();
            $table->integer('holidays')->nullable();
            $table->integer('salary_days')->nullable();
            $table->integer('saturdays_included')->nullable();
            $table->integer('sundays_included')->nullable();
            $table->bigInteger('calculated_salary')->nullable();
            $table->bigInteger('half_days')->nullable();
            $table->bigInteger('calculated_salary_without_deduction')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salary_slips', function (Blueprint $table) {
            //
        });
    }
}
