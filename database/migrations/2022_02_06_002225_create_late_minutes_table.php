<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLateMinutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('late_minutes', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->string('date');
            $table->integer('minutes');
            $table->enum('type', ['morning', 'evening', 'half_day'])->default('morning');
            $table->foreignUuid('employee_id')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::dropIfExists('late_minutes');
    }
}
