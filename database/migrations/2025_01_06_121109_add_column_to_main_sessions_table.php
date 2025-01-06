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
        Schema::table('main_sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id')->nullable()->after('stage_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
            $table->string('date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('main_sessions', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['teacher_id', 'date', 'start_time', 'end_time']);
        });
    }
};
