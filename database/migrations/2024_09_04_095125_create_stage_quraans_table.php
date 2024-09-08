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
        Schema::create('stage_quraan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('quraan_id')->nullable();
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('cascade');
            $table->foreign('quraan_id')->references('id')->on('quraan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage_quraans');
    }
};
