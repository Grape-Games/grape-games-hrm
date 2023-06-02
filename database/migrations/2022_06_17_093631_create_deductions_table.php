<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deductions', function (Blueprint $table) {
            $table->id();
             $table->foreignUuid('employee_id')->nullable()->references('id')->on('employees')->onDelete('cascade');
            $table->foreignUuid('assigned_by')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('month');
            $table->double('amount');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('deductions');
    }
}
