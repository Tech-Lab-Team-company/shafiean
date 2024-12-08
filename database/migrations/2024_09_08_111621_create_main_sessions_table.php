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
        Schema::create('main_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('session_type_id')->nullable();
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('surah_id')->nullable();
            $table->unsignedBigInteger('start_ayah_id')->nullable();
            $table->unsignedBigInteger('end_ayah_id')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('set null');
            $table->foreign('surah_id')->references('id')->on('surahs')->onDelete('set null');
            $table->foreign('start_ayah_id')->references('id')->on('ayahs')->onDelete('set null');
            $table->foreign('end_ayah_id')->references('id')->on('ayahs')->onDelete('set null');
            $table->foreign('session_type_id')->references('id')->on('session_types')->onDelete('set null');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_sessions');
    }
};
