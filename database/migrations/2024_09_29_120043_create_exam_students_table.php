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
        Schema::create('exam_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->nullable()->references('id')->on('organizations')->onDelete('cascade');
            $table->foreignId('exam_id')->nullable()->references('id')->on('exams')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->tinyInteger('grade')->nullable();
            $table->boolean('is_pass')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_students');
    }
};
