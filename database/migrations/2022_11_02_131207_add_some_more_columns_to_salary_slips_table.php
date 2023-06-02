<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeMoreColumnsToSalarySlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salary_slips', function (Blueprint $table) {
            $table->unsignedBigInteger('total_salary')->nullable();
            $table->unsignedBigInteger('absents')->nullable();
            $table->unsignedBigInteger('absent_deduction')->nullable();
            $table->unsignedBigInteger('half_day_deduction')->nullable();
            $table->unsignedBigInteger('late_minutes')->nullable();
            $table->unsignedBigInteger('late_minutes_deduction')->nullable();
            $table->unsignedBigInteger('sandwich_rule_deduction')->nullable();
            $table->unsignedBigInteger('other_deduction');
            $table->unsignedBigInteger('loan')->nullable();
            $table->unsignedBigInteger('bouns')->nullable();
            $table->unsignedBigInteger('tax_deduction')->nullable();
            $table->unsignedBigInteger('deduction_before_compensation')->nullable();
            $table->unsignedBigInteger('compensation')->nullable();
            $table->string('dated');
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
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
