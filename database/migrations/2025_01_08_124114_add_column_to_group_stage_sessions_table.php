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
        Schema::table('group_stage_sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('surah_id')->nullable()->after('session_type_id');
            $table->unsignedBigInteger('start_ayah_id')->nullable()->after('surah_id');
            $table->unsignedBigInteger('end_ayah_id')->nullable()->after('start_ayah_id');
            $table->string('title')->nullable()->after('end_ayah_id');
            $table->foreign('surah_id')->references('id')->on('surahs')->onDelete('set null');
            $table->foreign('start_ayah_id')->references('id')->on('ayahs')->onDelete('set null');
            $table->foreign('end_ayah_id')->references('id')->on('ayahs')->onDelete('set null');
            $table->string('date')->nullable()->after('title');
            $table->string('start_time')->nullable()->after('date');
            $table->string('end_time')->nullable()->after('start_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_stage_sessions', function (Blueprint $table) {
            $table->dropForeign(['surah_id']);
            $table->dropForeign(['start_ayah_id']);
            $table->dropForeign(['end_ayah_id']);
            $table->dropColumn('surah_id');
            $table->dropColumn('start_ayah_id');
            $table->dropColumn('end_ayah_id');
            $table->dropColumn('title');
            $table->dropColumn('date');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
};
