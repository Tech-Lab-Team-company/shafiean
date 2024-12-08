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
        Schema::create('stage_surahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('surah_id')->nullable();
            $table->boolean('is_full')->default(1)->nullable()->comment('1 = true, 0 = false');
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('cascade');
            $table->foreign('surah_id')->references('id')->on('surahs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage_surahs');
    }
};
