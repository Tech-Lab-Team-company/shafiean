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
        Schema::table('user_relations', function (Blueprint $table) {
            $table->renameColumn('user_id', 'parent_id');
            $table->renameColumn('student_id', 'child_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_relations', function (Blueprint $table) {
            $table->renameColumn('child_id', 'student_id');
            $table->renameColumn('student_id', 'user_id');
        });
    }
};
