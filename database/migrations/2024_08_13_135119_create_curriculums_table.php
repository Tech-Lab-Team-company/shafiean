<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumsTable extends Migration
{
    public function up()
    {
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 191)->nullable();
            $table->integer('type')->nullable();
            $table->string('time', 191)->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('order')->nullable();
            $table->unsignedBigInteger('curriculum_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('curriculums');
    }
}

