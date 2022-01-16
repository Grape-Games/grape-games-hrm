<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipColToEmployeeEmergencyContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_emergency_contacts', function (Blueprint $table) {
            $table->string('first_person_relationship')->nullable();
            $table->string('second_person_relationship')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_emergency_contacts', function (Blueprint $table) {
            //
        });
    }
}
