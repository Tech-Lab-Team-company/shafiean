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
        Schema::create('live100ms_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('live_id')->nullable();
            $table->string('room_id')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('enabled')->default(0)->nullable();
            $table->tinyInteger('recording')->default(0)->nullable();
            $table->tinyInteger('large_room')->default(0)->nullable();
            $table->string('region')->nullable();
            $table->string('host_code')->nullable();
            $table->string('guest_code')->nullable();
            $table->foreign('live_id')->references('id')->on('lives')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live100ms_infos');
    }
};
