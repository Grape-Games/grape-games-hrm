<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarySlipsTable extends Migration
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
            $table->unsignedBigInteger('basic_salary');
            $table->unsignedBigInteger('house_allowance')->nullable();
            $table->unsignedBigInteger('mess_allowance')->nullable();
            $table->unsignedBigInteger('travelling_allowance')->nullable();
            $table->unsignedBigInteger('medical_allowance')->nullable();
            $table->unsignedBigInteger('eid_allowance')->nullable();
            $table->unsignedBigInteger('other_allowance')->nullable();
            $table->unsignedBigInteger('advance_salary')->nullable();
            $table->unsignedBigInteger('electricity')->nullable();
            $table->unsignedBigInteger('arrears')->nullable();
            $table->unsignedBigInteger('income_tax')->nullable();
            $table->string('month_year');
            $table->foreignUuid('employee_id')->constrained();
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
