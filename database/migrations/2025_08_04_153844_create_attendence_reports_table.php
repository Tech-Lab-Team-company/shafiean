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
        Schema::create('attendence_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_by')->default(0);
            $table->timestamp('date')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('restrict');
            // $table->foreignId('organization_id')->nullable()->constrained('organizations')->onDelete('restrict');
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedTinyInteger('type')->default(0);
            $table->text('notes')->nullable();
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null');
            $table->boolean('is_absent')->default(false);
            $table->foreignId('report_id')->nullable()->constrained('reports')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendence_reports');
    }
};
