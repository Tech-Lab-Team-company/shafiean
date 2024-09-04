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
        Schema::create('stage_disability_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('disability_type_id')->nullable();
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('set null');
            $table->foreign('disability_type_id')->references('id')->on('disability_types')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage_disability_types');
    }
};
