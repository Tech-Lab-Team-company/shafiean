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
        Schema::create('session_student_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('rate')->nullable();
            $table->text('comment')->nullable();
            $table->foreign('session_id')->references('id')->on('group_stage_sessions')->onDelete('set null');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_student_rates');
    }
};
