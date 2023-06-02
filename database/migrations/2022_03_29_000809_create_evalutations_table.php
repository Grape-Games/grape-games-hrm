<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvalutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evalutations', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('employee_id')->nullable()->references('id')->on('employees')->onDelete('cascade');
            $table->string('month')->nullable();
            $table->integer('planning_coordination')->nullable();
            $table->integer('quality_work')->nullable();
            $table->integer('communication_skill')->nullable();
            $table->integer('overall_rating')->nullable();
            $table->integer('time_managment')->nullable();
            $table->text('additional_comments')->nullable();
            $table->text('over_all_performance')->nullable();
            $table->text('area_of_improvements')->nullable();
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
        Schema::dropIfExists('evalutations');
    }
}
