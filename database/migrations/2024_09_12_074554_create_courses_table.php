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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('year_id')->nullable();
            $table->unsignedBigInteger('curriculum_id')->nullable();
            $table->string('name')->nullable();
            $table->unsignedTinyInteger('status')->nullable()->default(1);
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');
            $table->foreign('year_id')->references('id')->on('years')->onDelete('set null');
            $table->foreign('curriculum_id')->references('id')->on('curriculums')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
