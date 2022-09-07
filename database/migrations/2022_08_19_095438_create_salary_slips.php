<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarySlips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_slips', function (Blueprint $table) {
          $table->uuid('id')->primary();
            $table->unsignedBigInteger('per_day')->nullable();
            $table->unsignedBigInteger('per_hour')->nullable();
            $table->unsignedBigInteger('per_minute')->nullable();
            $table->unsignedBigInteger('total_salary')->nullable();
            $table->unsignedBigInteger('absents')->nullable();
            $table->unsignedBigInteger('absent_deduction')->nullable();
            $table->unsignedBigInteger('half_days')->nullable();
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
            
            $table->unsignedBigInteger('total_deduction')->nullable();
            $table->unsignedBigInteger('deduction_after_compensation')->nullable();
            $table->unsignedBigInteger('approved_salary')->nullable();
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
        Schema::dropIfExists('salary_slips');
    }
}
