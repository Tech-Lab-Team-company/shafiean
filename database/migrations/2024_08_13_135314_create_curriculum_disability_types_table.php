<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumDisabilityTypesTable extends Migration
{
    public function up()
    {
        Schema::create('curriculum_disability_types', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('disability_type_id');
            $table->unsignedInteger('curriculum_id');

            $table->foreign('disability_type_id')->references('id')->on('disability_types')->onDelete('set null');
            $table->foreign('curriculum_id')->references('id')->on('curriculums')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('curriculum_disability_types');
    }
}

