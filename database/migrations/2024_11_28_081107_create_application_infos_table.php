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
        Schema::create('application_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->text('description')->nullable();
            $table->string('android_url')->nullable();
            $table->string('ios_url')->nullable();
            $table->string('image')->nullable();
            $table->string('type')->nullable()->comment('1 => teacher , 2 => student,3 => parent');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_infos');
    }
};
