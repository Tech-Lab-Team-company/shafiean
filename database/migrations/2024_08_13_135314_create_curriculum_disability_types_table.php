<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumDisabilityTypesTable extends Migration
{
    public function up()
    {
        Schema::create('curriculum_disability_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('disability_type_id')->nullable();
            $table->unsignedBigInteger('curriculum_id')->nullable();
            $table->foreign('disability_type_id')->references('id')->on('disability_types')->onDelete('set null');
            $table->foreign('curriculum_id')->references('id')->on('curriculums')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('curriculum_disability_types');
    }
}

