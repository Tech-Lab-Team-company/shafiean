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
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('quraan_id')->nullable();
            $table->unsignedBigInteger('session_type_id')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->string('title')->nullable();
            $table->text('start_verse')->nullable();
            $table->text('end_verse')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('set null');
            $table->foreign('quraan_id')->references('id')->on('quraan')->onDelete('set null');
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
