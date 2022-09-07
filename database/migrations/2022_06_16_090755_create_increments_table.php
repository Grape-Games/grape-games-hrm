<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncrementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('increments', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('employee_id')->nullable()->references('id')->on('employees')->onDelete('cascade');
            $table->foreignUuid('assigned_by')->references('id')->on('users')->onDelete('cascade');
            $table->string('date');
            $table->double('amount');
            $table->double('percentage');
            $table->double('last_increment')->nullable();
            $table->text('month')->nullable();
            $table->text('purpose')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('increments');
    }
}
