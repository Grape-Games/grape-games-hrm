<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAdditionalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_additional_information', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('job_description')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('cast_of_staff')->nullable();
            $table->string('certificate_name')->nullable();
            $table->string('resignation_date')->nullable();
            $table->string('dob')->nullable();
            $table->string('join_date')->nullable();
            $table->string('leave_date')->nullable();
            $table->string('referred_by')->nullable();
            $table->foreignUuid('employee_id')->constrained()->onDelete('cascade');;
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
        Schema::dropIfExists('employee_additional_information');
    }
}
