<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('father_name');
            $table->string('primary_contact');
            $table->string('secondary_contact')->nullable();
            $table->string('email_address')->unique();
            $table->string('city');
            $table->string('cnic')->unique();
            $table->string('enrollment_no');
            $table->string('registration_no')->unique();
            $table->foreignUuid('company_id')->constrained();
            $table->foreignId('designation_id')->constrained();
            $table->foreignUuid('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('user_id')->nullable()->constrained();
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
        Schema::dropIfExists('employees');
    }
}
