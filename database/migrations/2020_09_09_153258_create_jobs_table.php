<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assigned_user_id')->nullable();
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->text('description');
            $table->unsignedInteger('priority')->nullable();
            $table->unsignedBigInteger('completed_by')->nullable();
            $table->text('completed_note')->nullable();
            $table->timestamp('complete_before')->nullable();
            $table->timestamp('completed_at')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
