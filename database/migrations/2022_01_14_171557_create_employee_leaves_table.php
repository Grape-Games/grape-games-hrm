<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->bigInteger('number_of_leaves');
            $table->text('remarks')->nullable();
            $table->bigInteger('year');
            $table->foreignId('leave_type_id')->constrained();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignUuid('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('approved_by')->nullable()->references('id')->on('users')->nullable()->onDelete('cascade');
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
        Schema::dropIfExists('employee_leaves');
    }
}
