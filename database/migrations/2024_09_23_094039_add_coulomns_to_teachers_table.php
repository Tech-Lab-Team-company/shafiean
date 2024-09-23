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
            $table->tinyInteger('marital_status')->nullable()->default(0)->comment('0 => Single , 1 => Married');
            $table->tinyInteger('identity_type')->nullable()->default(0)->comment('0 => National ID , 1 => Passport');
            $table->string('identity_number')->nullable();
            $table->date('date_of_birth')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            //
        });
    }
};
