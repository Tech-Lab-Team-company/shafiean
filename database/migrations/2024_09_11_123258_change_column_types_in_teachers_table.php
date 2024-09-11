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
        Schema::table('teachers', function (Blueprint $table) {
            $table->unsignedTinyInteger('is_employed')->default(1)->change()->nullable()->comment('1 = teacher, 0 = employee');
            $table->unsignedTinyInteger('gender')->default(1)->change()->nullable()->comment('1 = male, 0 = female');
            $table->unsignedInteger('age')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->tinyInteger('is_employed')->default(1)->change()->nullable()->comment('1 = teacher, 0 = employee');
            $table->tinyInteger('gender')->default(1)->change()->nullable()->comment('1 = male, 0 = female');
            $table->integer('age')->change();
        });
    }
};
