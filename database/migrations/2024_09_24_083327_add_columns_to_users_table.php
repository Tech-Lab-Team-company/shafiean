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
            $table->string('date_of_birth')->nullable();
            $table->string('identity_type')->default(0)->comment('0 => National  , 1 => Passport');
            $table->string('identity_number')->nullable();
            $table->string('address')->nullable();
            $table->string('type')->default(0)->comment('0 => Student , 1 => Parent');
            $table->unsignedBigInteger('blood_type_id')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();

            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
