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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->nullable()->references('id')->on('organizations')->onDelete('cascade');
            $table->foreignId('curriculum_id')->nullable()->references('id')->on('curriculums')->onDelete('set null');
            $table->foreignId('season_id')->nullable()->references('id')->on('seasons')->onDelete('set null');
            $table->string('type')->nullable()->comment('1 => Article , 2 => Multiple Choice , 3 => Complete , 4 => Correction');
            $table->string('question')->nullable();
            $table->tinyInteger('degree')->nullable();
            $table->boolean('is_private')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
