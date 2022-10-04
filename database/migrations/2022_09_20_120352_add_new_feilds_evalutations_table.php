<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFeildsEvalutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evalutations', function (Blueprint $table) {
            $table->foreignUuid('approved_by')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->integer('total_rating')->nullable();
            $table->tinyInteger('status')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evalutations', function (Blueprint $table) {
            //
        });
    }
}
