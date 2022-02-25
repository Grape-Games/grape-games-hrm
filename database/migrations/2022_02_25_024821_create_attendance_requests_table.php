<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_requests', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('type');
            $table->string('query');
            $table->enum('status', ['opened', 'closed', 'resolved', 'rejected'])->default('opened');
            $table->string('remarks')->nullable();
            $table->foreignUuid('reviewed_by')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('submitted_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('attendance_requests');
    }
}
