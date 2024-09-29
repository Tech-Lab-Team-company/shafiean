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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->nullable()->references('id')->on('organizations')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->boolean('status')->default(1)->nullable()->comment('1 => Active , 0 => Inactive');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('duration')->nullable();
            $table->tinyInteger('question_count')->nullable();
            $table->tinyInteger('exam_type')->default(1)->nullable()->comment('1 => Audio , 2 => Multiple Choice , 3 => Matching , 4 => Correction');
            $table->tinyInteger('degree_type')->default(1)->nullable()->comment('1 => Percentage , 2 => Grade');
            $table->tinyInteger('degree')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
