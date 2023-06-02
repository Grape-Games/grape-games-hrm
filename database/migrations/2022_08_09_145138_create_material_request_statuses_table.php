<?php

use App\Models\MaterialRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialRequestStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_request_statuses', function (Blueprint $table) {
            $table->id();
            $table->text('comments')->nullable();
            $table->boolean('status')->default(false);
            $table->string('designation')->default(false);
            $table->foreignUuid('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreignIdFor(MaterialRequest::class)->constrained();
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
        Schema::dropIfExists('material_request_statuses');
    }
}
