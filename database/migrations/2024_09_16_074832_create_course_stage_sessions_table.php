<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_stage_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_stage_id')->nullable();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('session_type_id')->nullable();
            $table->tinyInteger('with_edit')->nullable()->default(0);
            $table->integer('start_verse')->nullable();
            $table->integer('end_verse')->nullable();
            $table->foreign('session_type_id')->references('id')->on('session_types')->onDelete('set null');
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('set null');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');
            $table->foreign('session_id')->references('id')->on('main_sessions')->onDelete('set null');
            $table->foreign('course_stage_id')->references('id')->on('course_stages')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_stage_sessions');
    }
};
