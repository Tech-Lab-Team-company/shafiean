<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->unsignedBigInteger('curriculum_type_id')->nullable()->after('id');

            $table->foreign('curriculum_type_id')
                ->references('id')
                ->on('curriculum_types')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->dropForeign(['curriculum_type_id']);
            $table->dropColumn('curriculum_type_id');
        });
    }
};
