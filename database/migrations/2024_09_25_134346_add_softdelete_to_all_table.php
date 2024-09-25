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
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('countries', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('cities', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('disability_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('admin_histories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('organizations', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('teachers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('curriculums', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('curriculum_disability_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('stages', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('terms', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('organization_disability_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('quraan', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('ayat', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('stage_disability_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('stage_quraan', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('session_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('main_sessions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('years', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('seasons', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('teacher_curriculums', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('course_disability_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('course_stages', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('course_stage_sessions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('group_stages', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('group_stage_sessions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('group_disabilities', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('days', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('group_days', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('images', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('blood_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('relations', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('user_relations', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('countries', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('cities', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('disability_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('admin_histories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('curriculums', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('curriculum_disability_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('stages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('terms', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('organization_disability_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('quraan', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('quraan_disability_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('stage_disability_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('stage_quraan', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('session_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('main_sessions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('years', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('seasons', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('teacher_curriculums', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('course_disability_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('course_stages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('course_stage_sessions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('group_stages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('group_stage_sessions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('group_disabilities', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('days', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('group_days', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('images', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('blood_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('relations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('user_relations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
