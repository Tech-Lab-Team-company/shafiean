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
        Schema::table('lives', function (Blueprint $table) {
            $table->dateTime('join_date')->nullable()->after('teacher_id');
            $table->dateTime('leave_date')->nullable()->after('join_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lives', function (Blueprint $table) {
            $table->dropColumn(['join_date', 'leave_date']);
        });
    }
};
