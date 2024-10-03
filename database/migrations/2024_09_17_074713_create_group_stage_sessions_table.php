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
        Schema::create('group_stage_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_stage_id')->nullable();
            $table->unsignedBigInteger('session_id')->nullable();
            // $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('session_type_id')->nullable();
            $table->tinyInteger('with_edit')->nullable()->default(0);
            $table->integer('start_verse')->nullable();
            $table->integer('end_verse')->nullable();
            $table->integer('duration')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->foreign('session_type_id')->references('id')->on('session_types')->onDelete('set null');
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('set null');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
            // $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');
            $table->foreign('session_id')->references('id')->on('main_sessions')->onDelete('set null');
            $table->foreign('group_stage_id')->references('id')->on('group_stages')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_stage_sessions');
    }
};
