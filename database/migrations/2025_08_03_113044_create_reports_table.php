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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('restrict');
            // $table->foreignId('organization_id')->nullable()->constrained('organizations')->onDelete('restrict');
            $table->unsignedInteger('degree')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedTinyInteger('type')->default(0);
            $table->text('notes')->nullable();
            $table->nullableMorphs('from_reportable');
            $table->nullableMorphs('from_sub_reportable');
            $table->nullableMorphs('to_reportable');
            $table->nullableMorphs('to_sub_reportable');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null');
            $table->boolean('is_absent')->default(false);
            $table->foreignId('group_id')->nullable()->constrained('groups')->onDelete('set null');
            $table->foreignId('stage_id')->nullable()->constrained('stages')->onDelete('set null');
            $table->foreignId('session_id')->nullable()->constrained('main_sessions')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
